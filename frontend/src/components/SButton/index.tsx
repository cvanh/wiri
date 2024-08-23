import { Pressable, StyleSheet, Text } from "react-native";

export default function SButton(props) {
  return (
    <Pressable style={style.button} {...props}>
      <Text>{props?.title}</Text>
    </Pressable>
  );
}

const style = StyleSheet.create({
  button: {
    marginTop: 16,
    paddingVertical: 8,
    borderWidth: 4,
    borderColor: "#2a437e",
    borderRadius: 10,
    backgroundColor: "#41d1b7",
    color: "#20232a",
    textAlign: "center",
    fontSize: 30,
    fontWeight: "bold",
    minWidth: 70,
  },
});
