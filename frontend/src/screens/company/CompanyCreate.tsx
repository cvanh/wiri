import { ErrorMessage, Formik } from 'formik'
import React, { useMemo, useState } from 'react'
import * as Yup from "yup";
import { ScrollView, StyleSheet, Text, TextInput, View } from 'react-native'
import axiosInstance from '../../lib/axiosInterceptor';

import { Picker } from '@react-native-picker/picker';
import LocationPicker from '../../components/LocationPicker';
import SButton from '../../components/SButton';

const CompanySchema = Yup.object().shape({
    name: Yup.string().required("Required"),
    about: Yup.string().required("Required"),
    type: Yup.string().required(),
    location: Yup.array(Yup.number()).required()
});

export default function CompanyCreate() {
    const [displayMessage, setDisplayMessage] = useState<String>();


    const createCompany = async (values) => {
        console.info("creating product:", values)
        const res = await axiosInstance.post("/api/company/create", {
            name: values.name,
            about: values.about,
            type: values.type,
            longitude: values.location[0],
            latitude: values.location[1]
        })
        if (res.status == 201) {
            setDisplayMessage("success")
        }
        if (res.status != 201) {
            setDisplayMessage(`http error: ${res.status}`)
        }

    }
    return (
        <ScrollView>
            {displayMessage && <Text>{displayMessage}</Text>}
            <Formik
                onSubmit={values => createCompany(values)}
                validationSchema={CompanySchema}
                initialValues={{ name: "", about: "", type: "", location: null }}
            >
                {({ setFieldValue, handleChange, handleBlur, handleSubmit, values }) => (
                    <View>
                        <ErrorMessage name="name" />
                        <TextInput
                            onChangeText={handleChange("name")}
                            placeholder="company name"
                            onBlur={handleBlur("name")}
                            value={values.name}
                            style={style.textInput}
                        />

                        <ErrorMessage name="about" />
                        <TextInput
                            onChangeText={handleChange("about")}
                            placeholder="description"
                            onBlur={handleBlur("about")}
                            style={style.textInput}

                            value={values.about}
                        />
                        <ErrorMessage name="type" />
                        <Picker
                            selectedValue={values.type}
                            onValueChange={handleChange("type")}>
                            <Picker.Item
                                value={"store"}
                                label={"store"}
                            />
                            <Picker.Item
                                value={"producer"}
                                label={"producer"}
                            />
                        </Picker>

                        <Text>select the location</Text>
                        <ErrorMessage name="location" />
                        <LocationPicker
                            value={values.location}
                            setFieldValue={setFieldValue}

                        />
                        <SButton onPress={handleSubmit} title="Submit" />
                    </View>
                )}
            </Formik>


        </ScrollView>
    )
}

const style = StyleSheet.create({
    textInput: {
        height: 35,
        borderColor: "gray",
        borderWidth: 0.5,
        padding: 4,
    },
    label: {
        fontSize: 20,
        margin: 4
    }
})