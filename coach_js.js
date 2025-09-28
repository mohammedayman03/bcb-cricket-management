document.addEventListener("DOMContentLoaded", function () {
    fetchSquadData();
});

function fetchSquadData() {
    fetch("api/getSquad.php")
        .then(response => response.json())
        .then(data => displaySquad(data))
        .catch(error => console.error('Error fetching squad data:', error));
}

function displaySquad(squad) {
    const squadList = document.getElementById("squadList");
    squadList.innerHTML = "";
    squad.forEach(player => {
        const listItem = document.createElement("li");
        listItem.textContent = player.name;
        squadList.appendChild(listItem);
    });
}
