import { View, Text, Button, StyleSheet, Pressable } from "react-native";
import SButton from "../components/SButton";

function HomeScreen({ navigation }) {
  return (
    <View
      style={{
        flex: 1,
        alignItems: "center",
        justifyContent: "center",
      }}
    >
      <Text>Home Screen</Text>

      <SButton onPress={() => navigation.navigate("Login")} title="login" />
      <SButton onPress={() => navigation.navigate("Product")} title="product" />
      <SButton onPress={() => navigation.navigate("Map")} title="map" />
    </View >
  );
}

const style = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    paddingTop: 10,
    backgroundColor: "#ecf0f1",
    padding: 8,
  },
})


export default HomeScreen;
