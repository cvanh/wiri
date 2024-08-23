import Mapbox, { Image } from '@rnmapbox/maps';
import React, { useEffect, useState } from 'react';
import { StyleSheet, Text, TouchableHighlight, View } from 'react-native';
import axiosInstance from '../lib/axiosInterceptor';

Mapbox.setAccessToken(process.env.EXPO_PUBLIC_MAPBOX_PUBLIC_KEY);
const ANNOTATION_SIZE = 50;

const corners = [
    {
        coordinate: [4.6503151, 52.1362613],
        anchor: { x: 1 / 3, y: 0 },
    },
];

const MapScreen = ({ navigation }) => {
    const [Companies, setCompanies] = useState();
    useEffect(() => {
        async function GetCompanies() {
            const res = await axiosInstance.get(`/api/company/`)
            const list = res.data.map((company) => {
                return {
                    id: company.id,
                    name: company.name,
                    coordinate: [company.longitude, company.latitude],
                    anchor: { x: 1 / 3, y: 0 },
                }
            })
            setCompanies(list)
        }
        GetCompanies()
    }, [])

    return (
        <View style={styles.container}>
            <Mapbox.MapView style={styles.map}>
                <Mapbox.Camera followZoomLevel={8} followUserLocation />
                <Mapbox.UserLocation />

                {Companies && Companies.map((p, i) => (
                    <Mapbox.PointAnnotation
                        key={`company-${i}`}
                        id={`company-${i}`}
                        coordinate={p.coordinate}
                        onSelected={() => { navigation.navigate("CompanyDetail", { id: p.id }) }}
                        anchor={p.anchor}
                    >
                        <View style={styles.small}>
                            <Text style={[styles.text]}>
                                {p.name} 
                            </Text>
                        </View>
                    </Mapbox.PointAnnotation>
                ))}
            </Mapbox.MapView>
        </View>
    );
}

const styles = StyleSheet.create({
    small: {
        backgroundColor: "hsla(143.11926605504587, 43.77510040160642%, 48.8235294117647%, 0.273)",
        borderRadius: 100,
        height: ANNOTATION_SIZE,
        justifyContent: 'center',
        width: ANNOTATION_SIZE,
        textAlign: "center",
        flex: 1,
    },
    text: {
        position: 'absolute',
        fontSize: 10,
    },
    matchParent: {
        flex: 1,
    },
    page: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
    },
    container: {
        flex: 1
    },
    map: {
        flex: 1
    }
});

export default MapScreen;
