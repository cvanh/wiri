import React, { useEffect, useState } from 'react';
import { Text, View } from 'react-native';
import axiosInstance from '../lib/axiosInterceptor';
import UserInterface from '../lib/interfaces/UserInterface';

const ProfileScreen = () => {
    const [User, setUser] = useState<UserInterface>()

    useEffect(() => {
        async function GetUser() {
            const res = await axiosInstance.get(`/api/user`)
            setUser(res.data)
        }
        GetUser()
    }, [])

    return (
        <View>
            <Text>your profile:</Text>
            {User && <>
                <Text>id {User.id}</Text>
                <Text>email_verified_at {User.email_verified_at}</Text>
                <Text>updated_at {User.updated_at}</Text>
                <Text>created_at {User.created_at}</Text>
            </>}
        </View>
    );
}


export default ProfileScreen;
