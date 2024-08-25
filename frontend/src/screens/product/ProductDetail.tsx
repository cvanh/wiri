import React, { useEffect, useState } from 'react';
import { Button, Text, View } from 'react-native';
import axiosInstance from '../../lib/axiosInterceptor';
import ProductInterface from '../../lib/interfaces/ProductInterface';
import ReviewInterface from '../../lib/interfaces/ReviewInterface';

const ProductDetail = ({ route, navigation }) => {
    const [Product, setProduct] = useState<ProductInterface, ReviewInterface>();
    const { id } = route.params
    useEffect(() => {
        async function getProduct() {
            const ProductRes = await axiosInstance.get(`/api/product/${id}`)
            const ReviewsRes = await axiosInstance.get(`/api/product/${id}/comments`)
            setProduct({ ...ProductRes.data, ...ReviewsRes.data })
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

            <Text>reviewss:</Text>
            {Product?.reviews && Product.reviews.map((review) => (
                <>
                    <Text>someone says:{review.content}</Text>
                </>
            ))}

        </View>
    );
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


export default ProductDetail;
