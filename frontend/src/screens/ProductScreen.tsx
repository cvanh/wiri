import { View, Text, StyleSheet, Image } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import ApiContext from '../lib/apiClient';

export default function ProductScreen({ navigator }) {
    const { apiClient } = useContext(ApiContext)
    const [products, setproducts] = useState();

    useEffect(() => {
        async function getProducts() {
            const data = await apiClient({ method: "GET", uri: "/api/product" })
            console.log('product data fetch', data)
            setproducts(data.data);
        }
        getProducts()
    }, []);

    console.log(products)
    return (
        <View style={style.container}>
            <Text>ProductScreen</Text>
            {products?.map((product) => (
                <View style={style.container} key={product.id}>
                    <Image source='./assets/placeholder.png' />
                    <Text>{product.name}</Text>
                    <Text style={style.productDescription}>{product.description}</Text>
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
    product: {
        // marginTop: 34,
        margin: 5,
        fontSize: 18,
        width: "50%",
        fontWeight: "bold",
    },
    productDescription: {
        fontSize: 12

    }
})