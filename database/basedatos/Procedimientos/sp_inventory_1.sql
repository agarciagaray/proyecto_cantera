CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_inventory`(IN _op varchar(50),IN _idMaterial varchar(50),IN _idTypeMov varchar(2),IN _idSociety varchar(50), IN _dateStart date,IN _dateEnd date,IN _idCommody varchar(50))
BEGIN
	CASE
		 WHEN _op ='inventory_mat' THEN
         		(SELECT distinct pro.prod_fecha, 'V' typeProduction, mat.mate_descripcion,if((select  sum(det.dtrm_cantdespachada) 
			from remissionsdetails as det where det.dtrm_idmaterial = mat.id and (det.date_detail >=_dateStart and det.date_detail <=_dateEnd)),(select  sum(det.dtrm_cantdespachada) 
			from remissionsdetails as det where det.dtrm_idmaterial = mat.id and (det.date_detail >=_dateStart and det.date_detail <=_dateEnd)),0) as salida_sale,0 salida_pro
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where  pro.prod_estado = 'A' and pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and pro.prod_fecha >=_dateStart and pro.prod_fecha <=_dateEnd)
            UNION
            (Select distinct pro.prod_fecha,pro.typeProduction, mat.mate_descripcion,0 salida_sale,pro.prod_volumen as salida_pro
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where pro.typeProduction = 'S' and pro.prod_estado = 'A' AND pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and (pro.prod_fecha >=_dateStart and pro.prod_fecha <=_dateEnd))
            union
            (Select distinct pro.prod_fecha,pro.typeProduction, mat.mate_descripcion,0 salida_sale,pro.prod_volumen as inventario
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where pro.typeProduction = 'I' and pro.prod_estado = 'A' AND pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and (pro.prod_fecha >=_dateStart and pro.prod_fecha <=_dateEnd))
            ORDER BY typeProduction = 'I' desc,  typeProduction = 'V' asc;
			/*(SELECT distinct pro.id, pro.prod_fecha, null typeProduction, mat.mate_descripcion,if((select  sum(det.dtrm_cantdespachada) 
			from remissionsdetails as det where det.dtrm_idmaterial = mat.id and (det.date_detail >=_dateStart and det.date_detail <=_dateEnd)),(select  sum(det.dtrm_cantdespachada) 
			from remissionsdetails as det where det.dtrm_idmaterial = mat.id and (det.date_detail >=_dateStart and det.date_detail <=_dateEnd)),0) as salida_sale,0 salida_pro
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where  pro.prod_estado = 'A' and pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and pro.prod_fecha >=_dateStart and pro.prod_fecha <=_dateEnd)
			UNION
			(Select distinct pro.id, pro.prod_fecha, pro.typeProduction, mat.mate_descripcion,0 salida_sale,pro.prod_volumen as salida_pro
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where pro.typeProduction = 'S' and pro.prod_estado = 'A' AND pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and (pro.prod_fecha >= _dateStart and pro.prod_fecha <=_dateEnd))
			UNION
			(Select distinct pro.id, pro.prod_fecha, pro.typeProduction, mat.mate_descripcion,0 salida_sale,pro.prod_volumen as inventario
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where pro.typeProduction = 'I' and pro.prod_estado = 'A' AND pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and (pro.prod_fecha >=_dateStart and pro.prod_fecha <=_dateEnd)) ORDER BY typeProduction = 'I' desc;*/
		 WHEN _op ='list_sale_filter_mat' THEN
			SELECT rm.id, mat.mate_descripcion,sum(rmt.dtrm_cantdespachada) as dtrm_cantdespachada,sum(rmt.transporte) as transporte,sum(rmt.suministro) as suministro FROM remissions as rm
			inner join remissionsdetails as rmt on rmt.dtrm_idremision = rm.id
			inner join materials as mat on rmt.dtrm_idmaterial = mat.id
			where rm.remi_estado = 'A' AND mat.id = _idMaterial
            GROUP BY mat.mate_descripcion;
		 WHEN _op ='sale_mat' THEN
			SELECT rm.id, mat.mate_descripcion,sum(rmt.dtrm_cantdespachada) as dtrm_cantdespachada,sum(rmt.transporte) as transporte,sum(rmt.suministro) as suministro FROM remissions as rm
			inner join remissionsdetails as rmt on rmt.dtrm_idremision = rm.id
			inner join materials as mat on rmt.dtrm_idmaterial = mat.id
			where rm.remi_estado = 'A'
            GROUP BY mat.mate_descripcion;
		WHEN _op ='sale_mat' THEN
			SELECT rm.id, mat.mate_descripcion,sum(rmt.dtrm_cantdespachada) as dtrm_cantdespachada,sum(rmt.transporte) as transporte,sum(rmt.suministro) as suministro FROM remissions as rm
			inner join remissionsdetails as rmt on rmt.dtrm_idremision = rm.id
			inner join materials as mat on rmt.dtrm_idmaterial = mat.id
			where rm.remi_estado = 'A'
            GROUP BY mat.mate_descripcion;
		WHEN _op ='list_material_society' THEN
			SELECT p.pers_razonsocial,mat.mate_descripcion, sum(rmt.dtrm_cantdespachada) as dtrm_cantdespachada from remissions as rm
			inner join remissionsdetails as rmt on rmt.dtrm_idremision = rm.id
			inner join materials as mat on rmt.dtrm_idmaterial = mat.id
			inner join societies as soc on rm.id_society = soc.id
			inner join persons as p on p.id = soc.id_person
			where rm.remi_estado ='A'
			GROUP BY mat.id;
		WHEN _op ='material_society' THEN
            select p.pers_razonsocial,mat.mate_descripcion, sum(rmt.dtrm_cantdespachada) as dtrm_cantdespachada from remissions as rm
			inner join remissionsdetails as rmt on rmt.dtrm_idremision = rm.id
			inner join materials as mat on rmt.dtrm_idmaterial = mat.id
			inner join societies as soc on rm.id_society = soc.id
			inner join persons as p on p.id = soc.id_person
			where rm.remi_estado ='A' and rm.id_society = _idSociety
			GROUP BY mat.id;
            
		WHEN _op ='list_commodies' THEN
			SELECT pro.prod_fecha as fecha,dev.disp_descripcion as dispositivo, CONCAT(mac.maqn_placa, ' ', mat.tmaq_nombre) as deposita,com.matp_descripcion as materia_prima,SUM(pro.prod_volumen) AS entrada
			FROM productions AS pro 
			INNER JOIN commodities AS com ON com.id = pro.prod_idmateriaprima
			INNER JOIN devices AS dev ON dev.id = pro.prod_iddispositivo
			INNER JOIN machines AS mac ON mac.id = pro.prod_idmaqdeposita
			INNER JOIN machinestypes AS mat ON mat.id =mac.maqn_tipo
            WHERE pro.typeProduction = 'E' AND pro.prod_estado = 'A';
			/*GROUP BY dev.id*/
            /*(SELECT distinct pro.prod_fecha, 'V' typeProduction, mat.mate_descripcion,if((select  sum(det.dtrm_cantdespachada) 
			from remissionsdetails as det where det.dtrm_idmaterial = mat.id and (det.date_detail >=_dateStart and det.date_detail <=_dateEnd)),(select  sum(det.dtrm_cantdespachada) 
			from remissionsdetails as det where det.dtrm_idmaterial = mat.id and (det.date_detail >=_dateStart and det.date_detail <=_dateEnd)),0) as salida_sale,0 salida_pro
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where  pro.prod_estado = 'A' and pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and pro.prod_fecha >=_dateStart and pro.prod_fecha <=_dateEnd)
            
            UNION
            (Select distinct pro.prod_fecha,pro.typeProduction, mat.mate_descripcion,0 salida_sale,pro.prod_volumen as salida_pro
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where pro.typeProduction = 'S' and pro.prod_estado = 'A' AND pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and (pro.prod_fecha >=_dateStart and pro.prod_fecha <=_dateEnd))
            union
            (Select distinct pro.prod_fecha,pro.typeProduction, mat.mate_descripcion,0 salida_sale,pro.prod_volumen as inventario
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where pro.typeProduction = 'I' and pro.prod_estado = 'A' AND pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial) and (pro.prod_fecha >=_dateStart and pro.prod_fecha <=_dateEnd))
            ORDER BY typeProduction = 'S' desc;*/
            
		WHEN _op ='commodies' THEN
			SELECT pro.prod_fecha as fecha,dev.disp_descripcion as dispositivo, CONCAT(mac.maqn_placa, ' ', mat.tmaq_nombre) as deposita,com.matp_descripcion as materia_prima,SUM(pro.prod_volumen) AS entrada
			FROM productions AS pro 
			INNER JOIN commodities AS com ON com.id = pro.prod_idmateriaprima
			INNER JOIN devices AS dev ON dev.id = pro.prod_iddispositivo
			INNER JOIN machines AS mac ON mac.id = pro.prod_idmaqdeposita
			INNER JOIN machinestypes AS mat ON mat.id =mac.maqn_tipo
			where pro.prod_fecha >= _dateStart and pro.prod_fecha <= _dateEnd AND com.id = _idCommody
            AND pro.typeProduction = 'E' AND pro.prod_estado = 'A'
           /* GROUP BY dev.id*/;
     ELSE
        BEGIN
        END;
    END CASE;
END