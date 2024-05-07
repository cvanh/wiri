import { View, Text, StyleSheet } from 'react-native'
import React, { useEffect, useState } from 'react'
import ApiModel from '../lib/models/WiriModel';

export default function ProductScreen() {
    const [products, setproducts] = useState();

    useEffect(() => {
        async function getProducts() {
            const data = await ApiModel.getProducts()
            setproducts(data.data);
        }
        getProducts()
    }, []);

    console.log(products)
    return (
        <View style={style.container}>
            <Text>ProductScreen</Text>
            {products?.map((product) => (
                <View style={style.product} key={product.id}>
                    <Text>{product.name}</Text>
                    <Text>{product.description}</Text>
                    <Text>{product.name}</Text>
                </View>
            ))}
        </View>
    )
}

const style = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: "center",
        paddingTop: 10,
        backgroundColor: "#ecf0f1",
        padding: 8,
    },
    title: {

    },
    product: {
        // marginTop: 34,
        margin: 24,
        fontSize: 18,
        width: 100,
        fontWeight: "bold",
        textAlign: "center",
    }
})