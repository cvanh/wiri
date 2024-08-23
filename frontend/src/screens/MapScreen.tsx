import Mapbox, { Image } from '@rnmapbox/maps';
import React from 'react';
import { StyleSheet, Text, View } from 'react-native';

Mapbox.setAccessToken(process.env.EXPO_PUBLIC_MAPBOX_PUBLIC_KEY);
const ANNOTATION_SIZE = 50;

const corners = [
    {
        coordinate: [4.6503151, 52.1362613],
        anchor: { x: 1 / 3, y: 0 },
    },
];

const MapScreen = () => {
    const onUserMarkerPress = (): void => {
        console.log('You pressed on the user location annotation');
    };
    return (
        <View style={styles.container}>
            <Mapbox.MapView style={styles.map}>
                <Mapbox.Camera followZoomLevel={12} followUserLocation />
                <Mapbox.UserLocation onPress={onUserMarkerPress} />

                {corners.map((p, i) => (
                    <Mapbox.PointAnnotation
                        key={`square-${i}`}
                        id={`square-${i}`}
                        coordinate={p.coordinate}
                        anchor={p.anchor}
                    >
                        <View style={styles.small}>
                            <Text style={[styles.text]}>
                                x={p.anchor.x.toPrecision(2)}, y={p.anchor.y.toPrecision(2)}
                                kaas
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
        backgroundColor: 'blue',
        height: ANNOTATION_SIZE,
        justifyContent: 'center',
        width: ANNOTATION_SIZE,
        flex: 1,
    },
    large: {
        borderColor: 'blue',
        backgroundColor: 'transparent',
        borderWidth: StyleSheet.hairlineWidth,
        height: ANNOTATION_SIZE * 2,
        justifyContent: 'center',
        width: ANNOTATION_SIZE * 2,
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
