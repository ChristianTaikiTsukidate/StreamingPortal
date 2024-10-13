document.querySelector('form').addEventListener('submit', function (e) {
    // Collect all multiselect groups by unique name
    const multiselectGroups = {};

    // Group checkboxes by their name attribute (multiselect label)
    document.querySelectorAll('[name$="[]"]').forEach(function (checkbox) {
        const name = checkbox.name;
        if (!multiselectGroups[name]) {
            multiselectGroups[name] = [];
        }
        multiselectGroups[name].push(checkbox);
    });

    // Iterate through each group and check if at least one checkbox is checked
    let allValid = true;

    for (const groupName in multiselectGroups) {
        const group = multiselectGroups[groupName];
        let oneChecked = group.some(checkbox => checkbox.checked);

        if (!oneChecked) {
            allValid = false;
            alert(`Please select at least one checkbox for ${groupName.replace('[]', '')}.`);
            e.preventDefault();
            break; // Stop validation if one group is invalid
        }
    }

    return allValid;
});