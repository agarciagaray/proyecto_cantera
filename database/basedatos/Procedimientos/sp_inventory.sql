			(Select  distinct pro.prod_fecha, null typeProduction, mat.mate_descripcion,(select  sum(det.dtrm_cantdespachada) 
			from remissionsdetails as det where det.dtrm_idmaterial = mat.id) as salida_sale,0 salida_pro
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where ((pro.typeProduction ="S" or pro.typeProduction ="I")  and pro.prod_estado = 'A'))


            /*or pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial)*/
			UNION 
			(Select distinct pro.prod_fecha, pro.typeProduction, mat.mate_descripcion,0 salida_sale,pro.prod_volumen as salida_pro
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where pro.typeProduction = 'S' and pro.prod_estado = 'A')
        

            /*or pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial)*/
            UNION 
			(Select pro.prod_fecha, pro.typeProduction, mat.mate_descripcion,0 salida_sale,pro.prod_volumen as inventario
			from productions as pro 
			inner join  materials as mat on mat.id = pro.prod_idmaterial
			where pro.typeProduction = 'I' and pro.prod_estado = 'A') ORDER BY typeProduction = 'I' desc  ;
            /*or pro.prod_idmaterial=if(isnull(_idMaterial),null,_idMaterial);*/