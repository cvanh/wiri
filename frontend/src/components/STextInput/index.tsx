import { StyleSheet, TextInput } from 'react-native'
import React from 'react'

export default function STextInput(props) {
    return (
        <TextInput
            {...props}
            style={style.textInput}
        />
    )
}

const style = StyleSheet.create({
    textInput: {
        height: 35,
        borderColor: "gray",
        borderWidth: 0.5,
        padding: 4,
    }
})