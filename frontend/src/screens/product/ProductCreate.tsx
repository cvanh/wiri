import { ErrorMessage, Formik } from 'formik'
import React, { useState } from 'react'
import * as Yup from "yup";
import { Button, StyleSheet, Text, TextInput, View } from 'react-native'
import axiosInstance from '../../lib/axiosInterceptor';

import { styled } from 'nativewind';
const StyledTextInput = styled(TextInput)
const StyledButton = styled(Button)


const ProductSchema = Yup.object().shape({
    name: Yup.string().required("Required"),
    description: Yup.string().required("Required"),
    producer_id: Yup.string().required()
});

export default function ProductCreate() {
    const [displayMessage, setDisplayMessage] = useState<String>();

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
            setDisplayMessage(`http error: ${res.status}`)
        }

    }
    return (
        <View className="bg-white" >
            {displayMessage && <Text>{displayMessage}</Text>}
            <Formik
                onSubmit={values => createProduct(values)}
                validationSchema={ProductSchema}
                initialValues={{ name: "", description: "", producer_id: "6c9efd63-4036-3f8c-80cb-221213fcee9b" }}
            >
                {({ handleChange, handleBlur, handleSubmit, values }) => (
                    <View>
                        <ErrorMessage name="name" />
                        <StyledTextInput
                            onChangeText={handleChange("name")}
                            placeholder="name"
                            onBlur={handleBlur("name")}
                            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                            value={values.name}
                        />

                        <ErrorMessage name="description" />
                        <StyledTextInput
                            onChangeText={handleChange("description")}
                            placeholder="description"
                            onBlur={handleBlur("description")}

                            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                            value={values.description}
                        />
                        <ErrorMessage name="producer_id" />
                        <StyledTextInput
                            onChangeText={handleChange("producer_id")}
                            placeholder="producer_id"
                            onBlur={handleBlur("producer_id")}
                            className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                            value={values.producer_id}
                        />
                        <StyledButton className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onPress={handleSubmit} title="Submit" />
                    </View>
                )}
            </Formik>


        </View>
    )
}

// const style = StyleSheet.create({
//     image: {
//         height: 100,
//         width: 100,
//         position: "absolute"
//     },
//     container: {
//         flex: 1,
//         justifyContent: "center",
//         paddingTop: 10,
//         backgroundColor: "#ecf0f1",
//         padding: 8,
//     },
//     textInput: {
//         height: 35,
//         borderColor: "gray",
//         borderWidth: 0.5,
//         padding: 4,
//     },
// })