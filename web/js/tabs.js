/**************************
* Tabs y combo selector
* Versión: 1.0
* Autor: Ricardo Pereyra
*
**************************/

	$(document).ready(function()
	{
		// Función que realiza el cambio de tabs
		$("input[name=tab-group]").change(function () {	
			for (a=0; a<20; a++)
			{
				if (("tab-"+a)==($(this).attr('id')))
				{
					document.getElementById("content-tab-"+a).style.display = 'block';
				}
				else
				{
					document.getElementById("content-tab-"+a).style.display = 'none';
				}
			}
		});
		
		// Función que realiza el cambio de combo
		$("select[class=comboselector]").change(function () {	
			for (a=0; a<99; a++)
			{
				nombrecombo1 = $(this).attr('id')+'-option'+a;
				nombrecombo2 = $(this).attr('id')+'-option'+$(this).val();
				if ((nombrecombo1==nombrecombo2) || ('999'==$(this).val()))
				{
					document.getElementById($(this).attr('id')+"-option"+a).style.display = 'block';
				}
				else
				{
					document.getElementById($(this).attr('id')+"-option"+a).style.display = 'none';
				}
			}
		});
		
	});
