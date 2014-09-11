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

function ri34() 
{
	ttm = document.getElementById( 'postform' ).elements['maksimum_kredit'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'postform' ).elements['maksimum_kredit'].value = kttm;


	ttm1 = document.getElementById( 'postform' ).elements['harga_tanah'].value;
	strtt1= ttm1.toString();
	kttm1 = kurensi(strtt1);
	
	document.getElementById( 'postform' ).elements['harga_tanah'].value = kttm1;


	ttm2 = document.getElementById( 'postform' ).elements['harga_bangunan'].value;
	strtt2= ttm2.toString();
	kttm2 = kurensi(strtt2);
	
	document.getElementById( 'postform' ).elements['harga_bangunan'].value = kttm2;

    ttm3 = document.getElementById( 'postform' ).elements['harga_tanah_imb'].value;
	strtt3= ttm3.toString();
	kttm3 = kurensi(strtt3);
	
	document.getElementById( 'postform' ).elements['harga_tanah_imb'].value = kttm3;

    ttm4 = document.getElementById( 'postform' ).elements['harga_bangunan_imb'].value;
	strtt4= ttm4.toString();
	kttm4 = kurensi(strtt4);
	
	document.getElementById( 'postform' ).elements['harga_bangunan_imb'].value = kttm4;
	
	ttm51 = document.getElementById( 'postform' ).elements['nilai_ht'].value;
	strtt51= ttm51.toString();
	kttm51 = kurensi(strtt51);
	document.getElementById( 'postform' ).elements['nilai_ht'].value = kttm51;

	
	ttm5 = document.getElementById( 'postform' ).elements['nilai_pertanggungan_ass_jiwa'].value;
	strtt5= ttm5.toString();
	kttm5 = kurensi(strtt5);
	
	document.getElementById( 'postform' ).elements['nilai_pertanggungan_ass_jiwa'].value = kttm5;
	
	ttm6 = document.getElementById( 'postform' ).elements['premi_jiwa'].value;
	strtt6= ttm6.toString();
	kttm6 = kurensi(strtt6);
	
	document.getElementById( 'postform' ).elements['premi_jiwa'].value = kttm6;

    ttm7 = document.getElementById( 'postform' ).elements['nilai_pertanggungan_ass_kerugian'].value;
	strtt7= ttm7.toString();
	kttm7 = kurensi(strtt7);
	
	document.getElementById( 'postform' ).elements['nilai_pertanggungan_ass_kerugian'].value = kttm7;
	
	ttm8 = document.getElementById( 'postform' ).elements['premi_kerugian'].value;
	strtt8= ttm8.toString();
	kttm8 = kurensi(strtt8);
	
	document.getElementById( 'postform' ).elements['premi_kerugian'].value = kttm8;
	
	ttm9 = document.getElementById( 'postform' ).elements['plafond_dimohon'].value;
	strtt9= ttm9.toString();
	kttm9 = kurensi(strtt9);
	
	document.getElementById( 'postform' ).elements['plafond_dimohon'].value = kttm9;
	
	ttm10 = document.getElementById( 'postform' ).elements['nilai_ht'].value;
	strtt10= ttm10.toString();
	kttm10 = kurensi(strtt10);
	
	document.getElementById( 'postform' ).elements['nilai_ht'].value = kttm10;
	
	ttm11 = document.getElementById( 'postform' ).elements['nilai_pertanggungan_ass_jiwa'].value;
	strtt11= ttm11.toString();
	kttm11 = kurensi(strtt11);
	
	document.getElementById( 'postform' ).elements['nilai_pertanggungan_ass_jiwa'].value = kttm11;
	
	ttm12 = document.getElementById( 'postform' ).elements['premi_jiwa'].value;
	strtt12= ttm12.toString();
	kttm12 = kurensi(strtt12);
	
	document.getElementById( 'postform' ).elements['premi_jiwa'].value = kttm12;
	
}