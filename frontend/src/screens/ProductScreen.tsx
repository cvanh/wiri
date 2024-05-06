import { View, Text } from 'react-native'
import React, { useEffect, useState } from 'react'
import ApiModel from '../lib/models/WiriModel';

export default function ProductScreen() {
    const [products, setproducts] = useState();

    useEffect(() => {
        async function getProducts() {
            const data = await ApiModel.getProducts()
            setproducts(data);
        }
        getProducts()
    }, []);

    console.log(products)
    return (
        <View>
            <Text>ProductScreen</Text>
        </View>
    )
}