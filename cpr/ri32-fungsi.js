function kurensi(nilai) 
{
		bk = nilai.replace(/[^\d]/g,"");
		ck = "";
		panjangk = bk.length;
		j = 0;
		for (i = panjangk; i > 0; i--) 
		{
			j = j + 1;
			if (((j % 3) == 1) && (j != 1)) 
			{
				ck = bk.substr(i-1,1) + "." + ck;
				xk = bk;
			} 
			else 
			{
				ck = bk.substr(i-1,1) + ck;
				xk = bk;
			}
		}
		return ck;
}

function ri32() 
{
	ttm = document.getElementById( 'postform' ).elements['max_kredit'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'postform' ).elements['max_kredit'].value = kttm;


	ttm1 = document.getElementById( 'postform' ).elements['cair_1'].value;
	strtt1= ttm1.toString();
	kttm1 = kurensi(strtt1);
	
	document.getElementById( 'postform' ).elements['cair_1'].value = kttm1;


	ttm2 = document.getElementById( 'postform' ).elements['cair_2'].value;
	strtt2= ttm2.toString();
	kttm2 = kurensi(strtt2);
	
	document.getElementById( 'postform' ).elements['cair_2'].value = kttm2;

    ttm3 = document.getElementById( 'postform' ).elements['cair_3'].value;
	strtt3= ttm3.toString();
	kttm3 = kurensi(strtt3);
	
	document.getElementById( 'postform' ).elements['cair_3'].value = kttm3;

    ttm4 = document.getElementById( 'postform' ).elements['cair_4'].value;
	strtt4= ttm4.toString();
	kttm4 = kurensi(strtt4);
	
	document.getElementById( 'postform' ).elements['cair_4'].value = kttm4;
	
	ttm5 = document.getElementById( 'postform' ).elements['outstanding'].value;
	strtt5= ttm5.toString();
	kttm5 = kurensi(strtt5);
	
	document.getElementById( 'postform' ).elements['outstanding'].value = kttm5;
	
	ttm6 = document.getElementById( 'postform' ).elements['jaminan'].value;
	strtt6= ttm6.toString();
	kttm6 = kurensi(strtt6);
	
	document.getElementById( 'postform' ).elements['jaminan'].value = kttm6;

    ttm7 = document.getElementById( 'postform' ).elements['bangunan'].value;
	strtt7= ttm7.toString();
	kttm7 = kurensi(strtt7);
	
	document.getElementById( 'postform' ).elements['bangunan'].value = kttm7;
	
	ttm8 = document.getElementById( 'postform' ).elements['induk'].value;
	strtt8= ttm8.toString();
	kttm8 = kurensi(strtt8);
	
	document.getElementById( 'postform' ).elements['induk'].value = kttm8;
}