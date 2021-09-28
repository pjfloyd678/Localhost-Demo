submitName = function() {
    const name_input = document.getElementById('name_input');
    debugger;
    const name = name_input.value;
    const character_array = name.split("");
    const reversed_characters_array = character_array.reverse();
    const reversed_name = reversed_characters_array.join("");
    document.getElementById('reversed_name').innerHTML = reversed_name;
}
