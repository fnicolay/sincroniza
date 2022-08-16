SELECT concat(u.firstname,'',u.lastname) as    nome_completo   , u.email as    email   , c.fullname as    nome_curso   ,g.name as    nome_grupo   
FROM prefix_user u
INNER JOIN prefix_role_assignments ra ON ra.userid = u.id
INNER JOIN prefix_context ct ON ct.id = ra.contextid
INNER JOIN prefix_course c ON c.id = ct.instanceid
INNER JOIN prefix_groups g ON g.courseid = c.id
INNER JOIN prefix_role r ON r.id = ra.roleid
INNER JOIN prefix_course_categories cc ON cc.id = c.category
WHERE r.id =5