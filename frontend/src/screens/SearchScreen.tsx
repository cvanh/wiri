import { View, Text, StyleSheet, ScrollView } from 'react-native'
import React, { useCallback, useState } from 'react'
import STextInput from '../components/STextInput';
import _ from "lodash"
import axiosInstance from '../lib/axiosInterceptor';
import SearchResultsInterface from '../lib/interfaces/SearchResultsInterface';

export default function SearchScreen() {
    const [Query, setQuery] = useState<String>();
    const [Results, setResults] = useState<SearchResultsInterface>();

    async function handleDebounceFn(query: string) {
        const res = await axiosInstance.get('/api/app/search', { params: { s: query } })
        console.log(res.data)
        setResults(res.data)
    }

    const debounceFn = useCallback(_.debounce(handleDebounceFn, 1000), [Query]);

    function handleChange(value: string) {
        setQuery(value);
        debounceFn(value);
    };

    return (
        <View>
            <Text>SearchScreen</Text>
            <STextInput
                editable
                multiline
                numberOfLines={4}
                maxLength={40}
                onChangeText={(query: string) => handleChange(query)}
                value={Query}
            />
            <ScrollView>
                {Results?.search_key && <Text>results for:{Results.search_key}</Text>}
                <Text style={{ fontSize: 20 }}>companies:</Text>
                <View style={style.result}>
                    {Results && Results?.companies?.map((company) => (
                        <Text key={company.id}>{company.name}</Text>
                    ))}
                </View>
                <Text style={{ fontSize: 20 }}>products:</Text>
                <View style={style.result}>
                    {Results && Results?.products?.map((product) => (
                        <Text key={product.id}>{product.name}</Text>
                    ))}
                </View>
            </ScrollView>

        </View>
    )
}

const style = StyleSheet.create({
    result: {
        backgroundColor: "#31a2a2sfs"
    }
})