import * as React from "react";
import { useEffect, useState } from "react";
import { NavigationContainer } from "@react-navigation/native";
import { createNativeStackNavigator } from "@react-navigation/native-stack";
import LoginScreen from "./src/screens/LoginScreen";
import HomeScreen from "./src/screens/HomeScreen";
import ProductScreen from "./src/screens/ProductScreen";
import CredentailsModel from "./src/lib/models/CredentailsModel";

const Stack = createNativeStackNavigator();

function App() {
  const [loggedIn, setloggedIn] = useState(false);

  useEffect(() => {
    async function getData() {
      const data = await CredentailsModel.get();
      console.log("asdasdasd", data);
      setloggedIn(data);
    }
    getData();
  }, []);

  console.debug("asd", loggedIn);

  return (
    <NavigationContainer>
      <Stack.Navigator>
        {!loggedIn ? (
          <Stack.Screen name="login" component={LoginScreen} />
        ) : (
          <>
            <Stack.Screen name="Home" component={HomeScreen} />
            <Stack.Screen name="Login" component={LoginScreen} />
            <Stack.Screen name="Product" component={ProductScreen} />
          </>
        )}
      </Stack.Navigator>
    </NavigationContainer>
  );
}

export default App;
