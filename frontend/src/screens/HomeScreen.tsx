import { View, Text, StyleSheet } from "react-native";
import SButton from "../components/SButton";
import React from "react";

function HomeScreen({ navigation }) {
  return (
    <View>
      <Text style={style.title}>Gekozen voor jouw</Text>

      <Text style={style.title}>In de buurt</Text>

      <View style={style.recomended}>
        <SButton onPress={() => navigation.navigate("Login")} title="login" />
        <SButton onPress={() => navigation.navigate("Product")} title="product" />
        <SButton onPress={() => navigation.navigate("Map")} title="map" />
        <SButton onPress={() => navigation.navigate("CompanyCreate")} title="add company" />
      </View>



    </View >
  );
}

const style = StyleSheet.create({
  title: {
    fontSize: 30,
    margin: 4,
  },
  recomended: {
    flexDirection: "row",
    paddingTop: 10,
    justifyContent: "center",
  },
})


export default HomeScreen;
