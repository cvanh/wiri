import React, { useContext } from "react";
import { Button, StyleSheet, Text, TextInput, View } from "react-native";
import CredentialsModel from "../lib/models/CredentailsModel"

import * as Yup from "yup";
import { ErrorMessage, Formik } from "formik";
import ApiContext from "../lib/apiClient";

const LoginSchema = Yup.object().shape({
  password: Yup.string()
    .min(8, "Too Short!")
    .required("Required"),
  email: Yup.string().email("Invalid email").required("Required"),
});

// TODO use correct types
export default function LoginScreen() {
  const { apiClient } = useContext(ApiContext)

  const login = async (values) => {
    await apiClient({ method: "head", uri: "/sanctum/csrf-cookie" })

    const loginRes = await apiClient({
      method: "POST",
      uri: "/sanctum/token",
      body: {
        email: values.email,
        password: values.password,
        device_name: "wiri app"
      }
    })

    if (loginRes.status !== 200 || !loginRes.data) {
      // TODO implement
      console.error("error while logging in")
    }
    values.token = loginRes.data
    console.log(values)

    CredentialsModel.set(values)
  }
  return (
    <View>
      <Formik
        initialValues={{ email: "admin@admin.test", password: "adminadmin" }}
        onSubmit={values => login(values)}
        validationSchema={LoginSchema}
      >
        {({ handleChange, handleBlur, handleSubmit, values }) => (
          <View>
            <ErrorMessage name="email" />
            <TextInput
              onChangeText={handleChange("email")}
              style={styles.textInput}
              placeholder="email"
              onBlur={handleBlur("email")}
              value={values.email}
            />

            <ErrorMessage name="password" />
            <TextInput
              onChangeText={handleChange("password")}
              style={styles.textInput}
              placeholder="password"
              onBlur={handleBlur("password")}
              value={values.password}
            />
            <Button onPress={handleSubmit} title="Submit" />
          </View>
        )}
      </Formik>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    paddingTop: 10,
    backgroundColor: "#ecf0f1",
    padding: 8,
  },
  paragraph: {
    marginTop: 34,
    margin: 24,
    fontSize: 18,
    fontWeight: "bold",
    textAlign: "center",
  },
  textInput: {
    height: 35,
    borderColor: "gray",
    borderWidth: 0.5,
    padding: 4,
  },
});
