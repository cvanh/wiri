import { Pressable, StyleSheet, Text } from "react-native";

export default function SButton(props) {
  return (
    <Pressable style={style.button} {...props}>
      <Text style={style.text}>{props?.title}</Text>
    </Pressable>
  );
}

const style = StyleSheet.create({
  button: {
    margin: 8,
    padding: 8,
    borderWidth: 4,
    borderColor: "#53a64c",
    borderRadius: 10,
    backgroundColor: "#53a64c",
    textAlign: "center",
    fontSize: 30,
    fontWeight: "bold",
    minWidth: 70,
  },
  text: {
    color: "#ffff",
    textAlign: "center"
  }
});
