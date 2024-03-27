import React from "react";
import { Button, StyleSheet, Text, TextInput, View } from "react-native";
import LoginCredential from "../types/LoginCredentialInterface";
import * as SecureStore from "expo-secure-store";

async function save(value: LoginCredential) {
  await SecureStore.setItemAsync("login_credentials", JSON.stringify(value));
}

// TODO use correct types
export default function LoginScreen({ navigation }): any {
  const [key, onChangeKey] = React.useState('Your key here');
  const [value, onChangeValue] = React.useState('Your value here');

  return (
    <View>
      <Button title="Go back" onPress={() => navigation.goBack()} />
      <Text style={styles.paragraph}>Save an item, and grab it later!</Text>
      <Button
        title="Save this key/value pair"
        onPress={(value) => {
          save(value);
        }}
      />
      <Text style={styles.paragraph}>🔐 Enter your key 🔐</Text>
      <TextInput
        style={styles.textInput}
        placeholder="Enter the key for the value you want to get"
      />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    paddingTop: 10,
    backgroundColor: '#ecf0f1',
    padding: 8,
  },
  paragraph: {
    marginTop: 34,
    margin: 24,
    fontSize: 18,
    fontWeight: 'bold',
    textAlign: 'center',
  },
  textInput: {
    height: 35,
    borderColor: 'gray',
    borderWidth: 0.5,
    padding: 4,
  },
});