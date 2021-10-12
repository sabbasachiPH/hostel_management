// http://localhost/hostel_group2/admin/api_data.php/?type=froom&floor_id=1
let hall_dropdown = document.getElementById("hall_id");
let floor_dropdown = document.getElementById("floor_id");
let room_dropdown = document.getElementById("room_id");

console.log("hall dropdown value", hall_dropdown.value);
console.log("floor dropdown value", floor_dropdown.value);
console.log("room dropdown ", room_dropdown.value);

async function get_hall() {
  const response = await fetch("http://localhost/hms_38/admin/api_data.php");
  const json_data = await response.json();
  console.log("hall", json_data);
  json_data.forEach((item, index) => {
    const option = `<option value="${item.hall_id}">${item.hall_name}</option>`;
    hall_dropdown.innerHTML += option;
  });
}

async function get_floor(hall_id) {
  const response = await fetch(
    "http://localhost/hms_38/admin/api_data.php/?type=floor&hall_id=" + hall_id
  );
  const json_data = await response.json();
  console.log("floor", json_data);
  floor_dropdown.innerHTML =
    "<option value='' selected disabled>Select Floor</option>";
  json_data.forEach((item, index) => {
    const option = `<option value="${item.floor_id}">${item.floor_name}</option>`;
    floor_dropdown.innerHTML += option;
  });
}
get_hall();
hall_dropdown.onchange = function () {
  console.log("hall", hall_dropdown.value);
  get_floor(hall_dropdown.value);
};

if (room_dropdown != null) {
  async function get_room(floor_id) {
    console.log(floor_id);
    const response = await fetch(
      "http://localhost/hms_38/admin/api_data.php/?type=froom&floor_id=" +
        floor_id
    );
    const json_data = await response.json();
    console.log("room", json_data);
    room_dropdown.innerHTML =
      "<option value='' selected disabled>Select Room</option>";
    json_data.forEach((item, index) => {
      const option = `<option value="${item.floor_id}">${item.room_no}</option>`;
      room_dropdown.innerHTML += option;
    });
  }

  floor_dropdown.onchange = function () {
    console.log("floor", floor_dropdown.value);
    get_room(floor_dropdown.value);
  };
}

// console.log("room", room_dropdown.value);
