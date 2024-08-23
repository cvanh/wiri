import { View, Text, StyleSheet, Image, Button } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import axiosInstance from '../../lib/axiosInterceptor';

export default function ProductScreen({ navigator, navigation }) {
    const [products, setproducts] = useState();

    useEffect(() => {
        async function getProducts() {
            const data = await axiosInstance.get("/api/product")
            setproducts(data.data);
        }
        getProducts()
    }, []);

    navigation.setOptions({
        headerRight: () => (
            <Button title="create" onPress={() => navigation.navigate("ProductCreate")} />
        ),
    });
    return (
        <View style={style.container}>
            <Text>ProductScreen</Text>

            {products?.map((product) => (
                <View style={style.container} key={product.id}>
                    <Image style={style.image} source={require('../../assets/placeholder.png')} />
                    <Text>{product.name}</Text>
                    <Text style={style.productDescription}>{product.description}</Text>
                </View>
            ))}
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