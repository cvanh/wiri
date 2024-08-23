import React, { useEffect, useState } from 'react';
import { Button, Text, View } from 'react-native';
import axiosInstance from '../../lib/axiosInterceptor';
import ProductInterface from '../../lib/interfaces/ProductInterface';

const ProductDetail = ({ route, navigation }) => {
    const [Product, setProduct] = useState<ProductInterface>();
    const { id } = route.params
    useEffect(() => {
        async function getProduct() {
            const res = await axiosInstance.get(`/api/product/${id}`)
            setProduct(res.data)
        }
        getProduct()
    }, []);
    return (
        <View>
            {Product && (
                <>
                    <Text>{Product.name}</Text>
                    <Text>{Product.description}</Text>
                    <Text>{Product.deleted_at}</Text>
                    <Text>{Product.created_at}</Text>
                    <Text>{Product.producer_id}</Text>
                    <Button title="view company" onPress={() => navigation.navigate("CompanyDetail", { id: Product.producer_id })} />
                    {Product.product_meta.map((meta, index) => (
                        <Text key={index}>{meta.meta_key}:{meta.meta_value}</Text>
                    ))}
                </>
            )}

        </View>
    );
}


export default ProductDetail;
