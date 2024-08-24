import { ErrorMessage, Formik } from 'formik'
import React, { useMemo, useState } from 'react'
import * as Yup from "yup";
import { ScrollView, StyleSheet, Text, TextInput, View } from 'react-native'
import axiosInstance from '../../lib/axiosInterceptor';

import { Picker } from '@react-native-picker/picker';
import LocationPicker from '../../components/LocationPicker';
import SButton from '../../components/SButton';

const ProductSchema = Yup.object().shape({
    name: Yup.string().required("Required"),
    description: Yup.string().required("Required"),
    producer_id: Yup.string().required(),
    location: Yup.array(Yup.number())
});

export default function ProductCreate() {
    const [displayMessage, setDisplayMessage] = useState<String>();
    const [Companies, setCompanies] = useState();
    useMemo(() => {
        async function GetCompanies() {
            const res = await axiosInstance.get(`/api/company/`)
            setCompanies(res.data)
        }
        GetCompanies()
    }, [])

    const createProduct = async (values) => {
        console.info("creating product:", values)
        const res = await axiosInstance.post("/api/product/create", {
            name: values.name,
            description: values.description,
            producer_id: values.producer_id,
            longitude: values.location[0],
            latidude: values.location[1]
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
                onSubmit={values => createProduct(values)}
                validationSchema={ProductSchema}
                initialValues={{ name: "", description: "", producer_id: "", location: null }}
            >
                {({ setFieldValue, handleChange, handleBlur, handleSubmit, values }) => (
                    <View>
                        <ErrorMessage name="name" />
                        <TextInput
                            onChangeText={handleChange("name")}
                            placeholder="name"
                            onBlur={handleBlur("name")}
                            value={values.name}
                            style={style.textInput}
                        />

                        <ErrorMessage name="description" />
                        <TextInput
                            onChangeText={handleChange("description")}
                            placeholder="description"
                            onBlur={handleBlur("description")}
                            style={style.textInput}

                            value={values.description}
                        />
                        <ErrorMessage name="producer_id" />
                        <Picker
                            selectedValue={values.producer_id}
                            onValueChange={handleChange("producer_id")}>
                            {Companies && Companies.map((company) => (
                                <Picker.Item
                                    key={`${company.id}_${company.name}`}
                                    value={company.id}
                                    label={company.name}
                                />
                            ))}
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