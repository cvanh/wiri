import Mapbox, { Callout, PointAnnotation } from '@rnmapbox/maps';
import React, { useEffect, useRef, useState } from 'react';
import { StyleSheet, Image, View } from 'react-native';

Mapbox.setAccessToken(process.env.EXPO_PUBLIC_MAPBOX_PUBLIC_KEY);
const ANNOTATION_SIZE = 50;

const LocationPicker = (props) => {
  const [Location, setLocation] = useState<Array<number> | null>(props?.value);
  const pointAnnotation = useRef<PointAnnotation>(null);

  useEffect(() => {
    props.value = Location
    props.setFieldValue("location", Location)
  }, [Location])

  return (
    <Mapbox.MapView
      {...props}
      onPress={(feature) => {
        setLocation(feature.geometry.coordinates);
      }}
      style={styles.map}
    >
      <Mapbox.Camera followZoomLevel={12} followUserLocation />
      <Mapbox.UserLocation />
      {Location && (
        <PointAnnotation
          id={'shop'}
          coordinate={Location}
          title={'shop'}
          draggable
          onSelected={(feature) => setLocation(feature.geometry.coordinates)}
          onDrag={(feature) => setLocation(feature.geometry.coordinates)}
          onDragStart={(feature) => setLocation(feature.geometry.coordinates)}
          onDragEnd={(feature) => setLocation(feature.geometry.coordinates)}
        // useRef={pointAnnotation}
        >
          <View style={styles.annotationContainer}>
            <Image
              style={styles.tinyLogo}
              source={{
                uri: 'https://reactnative.dev/img/tiny_logo.png',
              }}
            />
          </View>
        </PointAnnotation>
      )}
    </Mapbox.MapView>
  );
};

const styles = StyleSheet.create({
  small: {
    backgroundColor: 'hsla(143.11926605504587, 43.77510040160642%, 48.8235294117647%, 0.273)',
    borderRadius: 100,
    height: ANNOTATION_SIZE,
    justifyContent: 'center',
    width: ANNOTATION_SIZE,
    textAlign: 'center',
    flex: 1,
  },
  tinyLogo: {
    width: 50,
    height: 50,
  },

  annotationContainer: {
    alignItems: 'center',
    backgroundColor: 'white',
    borderColor: 'rgba(0, 0, 0, 0.45)',
    borderRadius: ANNOTATION_SIZE / 2,
    borderWidth: StyleSheet.hairlineWidth,
    height: ANNOTATION_SIZE,
    justifyContent: 'center',
    overflow: 'hidden',
    width: ANNOTATION_SIZE,
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
    // flex: 1,
  },
  map: {
    height: 250,
    width: 250,
  },
});

export default LocationPicker;
