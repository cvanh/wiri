import { View, Text, Button, StyleSheet, Pressable } from "react-native";
import SButton from "../components/SButton";

function HomeScreen({ navigation }) {
  return (
    <View>
      <Text style={style.title}>Gekozen voor jouw</Text>

      <Text style={style.title}>In de buurt</Text>

      <View style={style.recomended}>
        <SButton onPress={() => navigation.navigate("Login")} title="login" />
        <SButton onPress={() => navigation.navigate("Product")} title="product" />
        <SButton onPress={() => navigation.navigate("Map")} title="map" />
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
