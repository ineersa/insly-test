-- get employee with info in different languages
SELECT * FROM employee AS t
LEFT JOIN employee_translations et on t.id = et.employee_id;

-- get logs for employee
SELECT t.*, e.name FROM employee_log AS t
LEFT JOIN employee e on t.emplyee_id = e.id;