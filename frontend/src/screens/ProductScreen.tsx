import { View, Text } from 'react-native'
import React, { useEffect, useState } from 'react'
import ApiModel from '../lib/models/ApiModel';

export default function ProductScreen() {
    const [products, setproducts] = useState();

    useEffect(async () => {
        const data = await ApiModel.getProducts()
        setproducts(data);

    }, []);
    console.log(products)
    return (
        <View>
            <Text>ProductScreen</Text>
        </View>
    )
}