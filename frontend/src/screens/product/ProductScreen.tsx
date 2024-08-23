import { View, Text, Button, ScrollView, TouchableHighlight } from 'react-native'
import React, { useEffect, useState } from 'react'
import axiosInstance from '../../lib/axiosInterceptor';
import ProductInterface from '../../lib/interfaces/ProductInterface';

export default function ProductScreen({ navigator, navigation }): any {
    const [products, setproducts] = useState<ProductInterface[]>();

    useEffect(() => {
        async function getProducts() {
            const data = await axiosInstance.get("/api/product")
            setproducts(data.data);
        }
        getProducts()
    });

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
                    <TouchableHighlight key={product.id} onPress={() => { navigation.navigate("ProductDetail", { id: product.id }) }}>
                        <View className="m-2" >
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