import { ErrorMessage, Formik } from 'formik'
import React, { useState } from 'react'
import * as Yup from "yup";
import { Button, StyleSheet, Text, TextInput, View } from 'react-native'
import axiosInstance from '../../lib/axiosInterceptor';

const ProductSchema = Yup.object().shape({
    name: Yup.string().required("Required"),
    description: Yup.string().required("Required"),
    producer_id: Yup.string().required()
});

export default function ProductCreate() {
    const [displayMessage, setDisplayMessage] = useState();
    const createProduct = async (values) => {
        const res = await axiosInstance.post("/api/product/create", {
            name: values.name,
            description: values.description,
            producer_id: values.producer_id
        })
        if (res.status == 201) {
            setDisplayMessage("success")
        }
        if (res.status != 201) {
            setDisplayMessage("http error", res.status)
        }

    }
    return (
        <View style={style.container}>
            {displayMessage && <Text>{displayMessage}</Text>}
            <Formik
                onSubmit={values => createProduct(values)}
                validationSchema={ProductSchema}
                initialValues={{ name: "", description: "", producer_id: "6c9efd63-4036-3f8c-80cb-221213fcee9b" }}
            >
                {({ handleChange, handleBlur, handleSubmit, values }) => (
                    <View>
                        <ErrorMessage name="name" />
                        <TextInput
                            onChangeText={handleChange("name")}
                            style={style.textInput}
                            placeholder="name"
                            onBlur={handleBlur("name")}
                            value={values.name}
                        />

                        <ErrorMessage name="description" />
                        <TextInput
                            onChangeText={handleChange("description")}
                            style={style.textInput}
                            placeholder="description"
                            onBlur={handleBlur("description")}
                            value={values.description}
                        />
                        <ErrorMessage name="producer_id" />
                        <TextInput
                            onChangeText={handleChange("producer_id")}
                            style={style.textInput}
                            placeholder="producer_id"
                            onBlur={handleBlur("producer_id")}
                            value={values.producer_id}
                        />
                        <Button onPress={handleSubmit} title="Submit" />
                    </View>
                )}
            </Formik>


        </View>
    )
}

const style = StyleSheet.create({
    image: {
        height: 100,
        width: 100,
        position: "absolute"
    },
    container: {
        flex: 1,
        justifyContent: "center",
        paddingTop: 10,
        backgroundColor: "#ecf0f1",
        padding: 8,
    },
    textInput: {
        height: 35,
        borderColor: "gray",
        borderWidth: 0.5,
        padding: 4,
    },
})