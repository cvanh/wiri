import React, { useEffect, useState } from 'react';
import { Text, View } from 'react-native';
import axiosInstance from '../../lib/axiosInterceptor';
import CompanyInterface from '../../lib/interfaces/CompanyInterface';

const CompanyDetail = ({ route }) => {
    const [Company, setCompany] = useState<CompanyInterface>()
    const { id } = route.params

    useEffect(() => {
        async function GetCompany() {
            const res = await axiosInstance.get(`/api/company/${id}`)
            setCompany(res.data)
        }
        GetCompany()
    }, [])
    console.log(Company)

    return (
        <View>
            {Company?.name && <Text>name: {Company.name}</Text>}
            {Company?.about && <Text>about: {Company.about}</Text>}
            {Company?.longitude && <Text>longitude: {Company.longitude}</Text>}
            {Company?.latitude && <Text>latitude: {Company.latitude}</Text>}
        </View>
    );
}


export default CompanyDetail;
