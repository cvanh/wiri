import * as React from "react";
import { useEffect, useState } from "react";
import { createNativeStackNavigator } from "@react-navigation/native-stack";
import { NavigationContainer } from "@react-navigation/native";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import LoginScreen from "./src/screens/LoginScreen";
import HomeScreen from "./src/screens/HomeScreen";
import ProductScreen from "./src/screens/product/ProductScreen";
import CredentailsModel from "./src/lib/models/CredentailsModel";
import ProductCreate from "./src/screens/product/ProductCreate";
import ProductDetail from "./src/screens/product/ProductDetail";
import CompanyDetail from "./src/screens/company/CompanyDetail";
import MapScreen from "./src/screens/MapScreen";
import ProfileScreen from "./src/screens/ProfileScreen";
import SearchScreen from "./src/screens/SearchScreen";

const Stack = createNativeStackNavigator();
const Tab = createBottomTabNavigator();

function App() {
  const [loggedIn, setloggedIn] = useState(false);

  useEffect(() => {
    async function getData() {
      const data = await CredentailsModel.get();
      setloggedIn(data);
    }
    getData();
  }, []);

  function HomeKaas() {
    return (
      <Tab.Navigator>
        <Tab.Screen name="Home" component={HomeScreen} />
        <Tab.Screen name="Map" component={MapScreen} />
        <Tab.Screen name="Search" component={SearchScreen} />
        <Tab.Screen name="Profile" component={ProfileScreen} />
      </Tab.Navigator>
    );
  }

  return (
    <NavigationContainer>
      <Stack.Navigator>
        {!loggedIn ? (
          <Stack.Screen name="Login" component={LoginScreen} />
        ) : (
          <>
            <Stack.Screen
              name="App"
              options={{ headerShown: false }}
              component={HomeKaas}
            />
            <Stack.Screen name="ProductCreate" component={ProductCreate} />
            <Stack.Screen name="Product" component={ProductScreen} />
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
