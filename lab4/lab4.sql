SELECT nombre
FROM trabajador
WHERE tarifa >= 10 OR tarifa <= 12

SELECT oficio
FROM trabajador T, asignacion
WHERE T.id_t = (select id_t
			from asignacion
			where id_t = '435')

SELECT T.nombre
FROM trabajador T
WHERE T.id_t = T.id_supv


SELECT P.id_t
FROM (SELECT id_e, id_t
	FROM asignacion
	WHERE id_e ='111' OR id_e='210' OR id_e='312') AS P

SELECT nombre, id_t, oficio
FROM trabajador
WHERE id_t ='1311' OR id_t = '2920' AND oficio = 'ELECTRICISTA'

SELECT T.nombre
from trabajador t, trabajador b
WHERE t.id_supv = b.id_t AND t.tarifa >b.tarifa
					
SELECT SUM(a.num_dias) as numdias 
FROM asignacion a, trabajador t
where a.id_e='312' AND a.id_t=t.id_t
and oficio ='fontanero'
--8

--9 
select e.tipo, AVG(nivel_calidad) as calidad
from edificio E
where e.categoria=1
GROUP BY e.tipo
having MAX(e.nivel_calidad)<=3
--10
select DISTINCT t.nombre
from trabajador t
where t.tarifa < (select AVG(t1.tarifa)
					FROM trabajador t1
					where t1.oficio =t.oficio
					group by t1.oficio)




