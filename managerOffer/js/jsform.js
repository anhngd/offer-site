function add_country(country_cc,country_text)
{
	var country_selected=document.getElementsByName("country_selected")[0];
	var option = document.createElement("option");
	option.text=country_text;
	option.value=country_cc;
	country_selected.add(option);
	var country_list=document.getElementsByName("country_list")[0];
 	country_list.remove(country_list.selectedIndex);
	document.getElementById("country").value+=country_cc+",";
}
function remove_country(country_cc,country_text)
{
	country_selected=document.getElementsByName("country_selected")[0];
	country_selected.remove(country_selected.selectedIndex);
	country_selected.selected=true;
	var country_list=document.getElementsByName("country_list")[0];
	var option = document.createElement("option");
	option.text=country_text;
	option.value=country_cc;
	country_list.add(option);
	country=document.getElementById("country").value.replace(country_cc+",","");
	document.getElementById("country").value=country;
}