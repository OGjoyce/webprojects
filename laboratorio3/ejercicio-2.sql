#1
SELECT nombre, edad, ciclo, especialidad
FROM estudiantes E
WHERE E.ciclo = '3o.' OR E.ciclo='5o.' OR E.ciclo='7o.'
ORDER BY E.edad
#2
select nombre, carnet 
from estudiantes 
where (nombre like 'B%') or (nombre like 'R%');

#6
SELECT count(carnet) as cantidad
FROM estudiantes
#7
select count(*) as especialidades 
from (select distinct especialidad from estudiantes) E;
#8
SELECT curso, count(*)
FROM asignaciones
GROUP BY curso
HAVING count(*) = (SELECT MAX(C.cantidad)
                   FROM (SELECT count(*) as cantidad
                         FROM asignaciones
                         GROUP BY curso) C)
#9
select especialidad, count(*) as n_alumno 
from estudiantes 
group by especialidad;

#10
SELECT especialidad
FROM estudiantes
GROUP BY especialidad
HAVING count(*)>2