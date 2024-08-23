import { View, Text, StyleSheet, Image, Button, ScrollView, TouchableHighlight } from 'react-native'
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
        <View>
            <Text>ProductScreen</Text>
            <ScrollView>
                {products?.map((product) => (
                    <TouchableHighlight onPress={() => { navigation.navigate("ProductDetail", { id: product.id }) }}>
                        <View className="m-2" key={product.id}>
                            {/* <Image source={require('../../assets/placeholder.png')} /> */}
                            <Text>{product.name}</Text>
                            <Text>{product.description}</Text>
                        </View>
                    </TouchableHighlight>
                ))}
            </ScrollView>
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
//     product: {
//         // marginTop: 34,
//         margin: 5,
//         fontSize: 18,
//         width: "50%",
//         fontWeight: "bold",
//     },
//     productDescription: {
//         fontSize: 12

//     }
// })