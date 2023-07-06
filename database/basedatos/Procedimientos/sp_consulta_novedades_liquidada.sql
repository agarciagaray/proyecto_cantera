DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consulta_novedades_liquidada`(IN _idobra INT, IN _idconcepto1  INT,IN _idconcepto2  INT,IN _idconcepto3  INT, IN  _fechaini date ,IN  _fechafin date )
BEGIN
SELECT
	r.id,
    r.remi_numfactura,
    r.rem_porc_sum,
    r.rem_porc_trans,
	r.num_remission,
	d.dtrm_idmaterial,
	m.mate_descripcion,
	d.dtrm_precio,
	r.remi_fecha fecharem,
	r.id_obra  obrarem,
	o.obra_nombre nombreobrarem,
	d.dtrm_cantdespachada volumenrem,	
	d.dtrm_precio preciorem,
	ROUND(d.valor_iva/d.suministro *100,2) as porc_iva,
	if(ISNULL(n1.clientenov),pr.pers_razonsocial, n1.clientenov) cliente_fac, 
	if(ISNULL(n1.obranov),o.obra_nombre, n1.obranov) obrafac ,
	if(ISNULL(n2.nuevovalor),d.dtrm_cantdespachada, n2.nuevovalor) cant_fac,
	if(ISNULL(n3.fechanov3), r.remi_fecha, n3.fechanov3) fecha_fac,
    if(isnull(n2.rmnv_valor_iva),d.valor_iva,n2.rmnv_valor_iva) valorivarem,
    if(isnull(n2.rmnv_valor_transporte),d.transporte,n2.rmnv_valor_transporte) transporterem,
    if(isnull(n2.rmnv_valor_suministro),d.suministro,n2.rmnv_valor_suministro) suministrorem,
	if(isnull(n2.rmnv_valor_subtotal), d.dtrm_cantdespachada * d.dtrm_precio,n2.n2.rmnv_valor_subtotal) as  subtotalrem,
	n2.rmnv_valor_subtotal,
    /*
    
	d.valor_iva valorivarem,
	d.suministro suministrorem,
	d.transporte transporterem,
    d.dtrm_cantdespachada * d.dtrm_precio as subtotalrem,
    d.subtotal totalrem,
    
   	if(ISNULL(n1.clientenov),o.obra_idcliente, n1.clientenov) cliente_fac, 
	if(ISNULL(n1.obranov),o.id, n1.obranov) obrafac ,
	if(ISNULL(n2.nuevovalor),d.dtrm_cantdespachada, n2.nuevovalor) cant_fac,
	if(ISNULL(n3.fechanov3), r.remi_fecha, n3.fechanov3) fecha_fac,
    
    */
    o.obra_nombre as obra_rem,
	pr.pers_razonsocial as clienterem
FROM
	remissions r
	LEFT JOIN remissionsdetails d ON r.id = dtrm_idremision 
	LEFT JOIN materials m on d.dtrm_idmaterial=m.id
	INNER JOIN constructions o on r.id_obra=o.id
	INNER JOIN clients c on o.obra_idcliente = c.id
	INNER JOIN persons as pr ON pr.id=c.id_person
	LEFT JOIN 
	(
		SELECT
		rmnv_idremision,
		rmnv_idconcepto,
		pe.pers_razonsocial as clientenov,
	con.obra_nombre as obranov
		FROM
		remissionsnovelties 
		LEFT JOIN clients as cl ON cl.id=rmnv_idclient
        LEFT JOIN persons as pe ON pe.id=cl.id_person
		LEFT JOIN constructions as con ON con.id=id_construction
	WHERE
		remissionsnovelties.id =
		(
			SELECT
				max( remissionsnovelties.id ) 
			FROM
				remissionsnovelties
				LEFT JOIN remissions ON remissionsnovelties.rmnv_idremision = remissions.id 
			WHERE
				rmnv_idconcepto = _idconcepto1
			AND remissions.id_obra = _idobra 
			AND remissionsnovelties.rmnv_estado !='I'
		)  
	)  as n1 on r.id=n1.rmnv_idremision
		LEFT JOIN(
		SELECT
		id,
		rmnv_idremision,
		rmnv_idconcepto,
		rmnv_nuevovalor  nuevovalor,
		rmnv_valor_iva,
        rmnv_valor_transporte,
        rmnv_valor_suministro,
        rmnv_valor_subtotal
        
		FROM
		remissionsnovelties 
	WHERE
		remissionsnovelties.id =
		(
			SELECT
				max( remissionsnovelties.id ) 
			FROM
				remissionsnovelties
				LEFT JOIN remissions ON remissionsnovelties.rmnv_idremision = remissions.id 
			WHERE
				rmnv_idconcepto = _idconcepto2 
			AND remissions.id_obra = _idobra 
			AND remissionsnovelties.rmnv_estado!='I'
		)  
	)  as n2 on r.id=n2.rmnv_idremision
	LEFT JOIN(
	SELECT
		id,
		rmnv_idremision,
		rmnv_idconcepto,
		rmnv_fecha fechanov3
		FROM
		remissionsnovelties 
	WHERE
		remissionsnovelties.id =
		(
			SELECT
				max( remissionsnovelties.id ) 
			FROM
				remissionsnovelties
				LEFT JOIN remissions ON remissionsnovelties.rmnv_idremision = remissions.id 
			WHERE
				rmnv_idconcepto = _idconcepto3 
			AND remissions.id_obra = _idobra
			AND remissionsnovelties.rmnv_estado!='I'
		)  
	)  as n3 on r.id=n3.rmnv_idremision
		WHERE
	r.remi_fecha BETWEEN _fechaini 
	AND _fechafin
	AND r.id_obra=_idobra 	
	AND r.remi_estado!='AN'
	AND r.remi_estado!='I'
    AND r.id in (select id_remission from settlementremissions where status='F')
	AND r.remi_numfactura != "";
	#Routine body goes here...

END