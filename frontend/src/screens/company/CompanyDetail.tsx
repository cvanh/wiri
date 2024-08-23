import React, { useEffect, useState } from 'react';
import { Text, View } from 'react-native';
import axiosInstance from '../../lib/axiosInterceptor';

const CompanyDetail = ({ route }) => {
    const [Company, setCompany] = useState()
    const { id } = route.params

    useEffect(() => {
        async function GetCompany() {
            const res = await axiosInstance.get(`/api/company/${id}`)
            setCompany(res.data)
        }
        GetCompany()
    }, [])

    return (
        <View>
            {Company?.name && <Text>name: {Company.name}</Text>}
        </View>
    );
}


export default CompanyDetail;
