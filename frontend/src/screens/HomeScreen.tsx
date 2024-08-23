import { View, Text, Button } from "react-native";

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
      <Button title="Login" onPress={() => navigation.navigate("Login")} />
      <Button title="product" onPress={() => navigation.navigate("Product")} />
      <Button title="Map" onPress={() => navigation.navigate("Map")} />
    </View>
  );
}

export default HomeScreen;
