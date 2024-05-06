import { View, Text } from 'react-native'
import React, { useEffect, useState } from 'react'
import ApiModel from '../lib/models/ApiModel';

export default function ProductScreen() {
    const [products, setproducts] = useState();

    useEffect(() => {
        async function getProducts() {
            const data = await ApiModel.getProducts()
            console.log(data)
            // setproducts(data);
        }
        getProducts()
    }, [products]);
    console.log(products)
    return (
        <View>
            <Text>ProductScreen</Text>
        </View>
    )
}