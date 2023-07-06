DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consulta_movimiento_maquina`(IN _idmaquina INT, IN _fechaini date ,IN  _fechafin date)
BEGIN
select machines.maqn_placa, mqmv_fecha, mqmv_hinicio, mqmv_hfin,horometro_hinicio,horometro_hfinal,mqmv_vlrhora, mqmv_obs, 
        TIME_TO_SEC(TIMEDIFF(CONCAT(mqmv_fecha,' ',mqmv_hfin), CONCAT(mqmv_fecha,' ',mqmv_hinicio))) /3600 as diffHora,
        CAST(horometro_hfinal -horometro_hinicio AS DECIMAL(10,2)) as diffHorometro , null tanq_volumen, null ccmb_vlrunidad,null mqpg_vlrpagado,
        null tanq_origen
        from machinesmov
        INNER JOIN machines ON machines.id=mqmv_idmaquina
        where mqmv_idmaquina=_idmaquina AND mqmv_fecha >= _fechaini AND mqmv_fecha <=_fechafin

        UNION
        select machines.maqn_placa, mqdt_fecha  mqmv_fecha, null  mqmv_hinicio, null mqmv_hfin, null horometro_hinicio, null horometro_hfinal, NULL mqmv_vlrhora,
        mqdt_obs mqmv_obs, NULL diffHora, NULL diffHorometro,null tanq_volumen,null ccmb_vlrunidad,null mqpg_vlrpagado,null tanq_origen
        from machinesobs
        INNER JOIN machines ON machines.id=mqdt_idmaquina
        where  mqdt_idmaquina=_idmaquina and mqdt_fecha >= _fechaini and mqdt_fecha <=_fechafin  
         
        UNION
         select  machines.maqn_placa, mqpg_fecha  mqmv_fecha, null  mqmv_hinicio, null mqmv_hfin, null horometro_hinicio, null horometro_hfinal, NULL mqmv_vlrhora,mqpg_obs mqmv_obs,  NULL diffHora, NULL diffHorometro,null tanq_volumen, null ccmb_vlrunidad
         ,mqpg_vlrpagado ,null tanq_origen
         from machinespayments 
         INNER JOIN machines ON machines.id=mqpg_idmaquina 
         where  mqpg_idmaquina=_idmaquina
         and mqpg_fecha >= _fechaini and mqpg_fecha <=_fechafin
         
		UNION
        select machines.maqn_placa, tanq_fecha  mqmv_fecha,  null  mqmv_hinicio, null mqmv_hfin, null horometro_hinicio, null horometro_hfinal, NULL mqmv_vlrhora,tanq_observaciones  mqmv_obs, NULL diffHora, NULL diffHorometro, tanq_volumen,if(ISNULL(fuelsshopping.ccmb_vlrunidad),tanq_valor_tanqueo,fuelsshopping.ccmb_vlrunidad) ccmb_vlrunidad,null mqpg_vlrpagado,
        tanq_origen
        from tankmachines 
        LEFT JOIN fuelsshopping ON tankmachines.cubt_idcompra= fuelsshopping.id
        INNER JOIN machines ON machines.id=tanq_idmaquina
        where  tanq_idmaquina=_idmaquina  and tanq_fecha >= _fechaini and  tanq_fecha <=_fechafin
        ORDER BY mqmv_fecha;
END