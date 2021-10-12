SELECT u.university_name,h.hall_name,f.floor_name,r.room_no,s.seat_no FROM university_information u 	
LEFT JOIN hall_information h ON u.id = h.university_id
LEFT JOIN floor_information f USING(hall_id)
LEFT JOIN room_information r USING(floor_id)
LEFT JOIN seat_information s USING(room_id)
ORDER BY h.hall_name,f.floor_name;

-- Seat Status
SELECT si.seat_id, ssi.status  FROM seat_information si
LEFT JOIN `seat_status_information` ssi
ON si.seat_status = ssi.status_id