import * as React from "react";
import { useEffect, useState } from "react";
import { NavigationContainer } from "@react-navigation/native";
import { createNativeStackNavigator } from "@react-navigation/native-stack";
import LoginScreen from "./src/screens/LoginScreen";
import HomeScreen from "./src/screens/HomeScreen";
import ProductScreen from "./src/screens/product/ProductScreen";
import CredentailsModel from "./src/lib/models/CredentailsModel";
import ProductCreate from "./src/screens/product/ProductCreate";
import ProductDetail from "./src/screens/product/ProductDetail";
import CompanyDetail from "./src/screens/company/CompanyDetail";
import MapScreen from "./src/screens/MapScreen";

const Stack = createNativeStackNavigator();

function App() {
  const [loggedIn, setloggedIn] = useState(false);

  useEffect(() => {
    async function getData() {
      const data = await CredentailsModel.get();
      setloggedIn(data);
    }
    getData();
  }, []);

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
            <Stack.Screen name="ProductCreate" component={ProductCreate} />
            <Stack.Screen name="ProductDetail" component={ProductDetail} />

            <Stack.Screen name="CompanyDetail" component={CompanyDetail} />
            <Stack.Screen name="Map" component={MapScreen} />
          </>
        )}
      </Stack.Navigator>
    </NavigationContainer>
  );
}

export default App;
