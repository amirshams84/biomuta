<?php session_start();
set_time_limit(480);
ini_set("memory_limit","-1");
ini_set("allow_url_include","1");
ini_set("auto_detect_line_endings", "1");
if(isset($_GET['gene']))$x=$_GET['gene'];
elseif(isset($_POST['query'])){
$name=$_POST['query'];
$y=$name[0];
$x=strtoupper($name[1]);
$temp=explode('.',$x);
$x=$temp[0];

}
//echo "gene name";
//echo $x;
//unset($_POST["Gene"]);
//$_SESSION["Gene"]=$_POST["Gene"];
$string='';
for(;;){
$rand=rand(20,400);
$fdata='data'.$rand.'.php';
$tempz='result'.$rand.'.csv';
$flnm="/home/ashamsad/biomuta-rev/";
if(file_exists($flnm.$tempz)){
$filecreationtime=filectime($flnm.$tempz);
$fileage=time()-$filecreationtime;
if($fileage>3600){
        unlink($flnm.$tempz);
        unlink($flnm.$fdata);
        }
}
elseif(!file_exists($flnm.$tempz))break;
}
file_put_contents($flnm.$tempz,$string);
file_put_contents($flnm.$fdata,$string);
////////////////////////////////////
///////////EDRN SAMPLING
$handle1 = fopen($flnm."/edrn.csv", "r");
for($i=0;$i<848;$i++){
  $edrn[$i] = fgetcsv($handle1,1024,',');
  //print_r($edrn[$i]);
  //echo "<br>";
  
}

////////////////////////
$x0b="\x6dy\x73\161l\x5f\x65\162\x72\x6f\162"; $x0c="m\171\163q\x6c\x5fs\x65\154\145\x63\164_\x64\142"; 
mysql_connect("\x6co\x63a\x6c\150os\164", "\141s\150am\163\x61d","\x4e\141\166\x61\x64\x65h\x31\062") or die($x0b());$x0c("\142\151\157\155ut\141") or die($x0b());

$query="SELECT * FROM TSUNG_JUNG WHERE (Gene_Name='".$x."' OR UniProt_AC='".$x."' OR Accession LIKE '".$x."%')  ORDER BY Status DESC ";
$string='BioMuta Result from Searching '.$x.'';
// Get all the data from the "example"table
$result = mysql_query($query)
or die(mysql_error()); 
//echo "number of records";


if(mysql_fetch_array( $result )==0){
$flag=0;
$caption='';
//echo "HELLO";
$string.="\n No result for ".$x." in BioMuta";
$table='';
//$table.="<thead><th >UniProtKB AC</th><th>Gene</th><th>Accession</th><th>SNV position</th><th>Position(N)</th><th>Ref(N)</th><th>Var(N)</th><th>Position(A)</th><th>Ref(A)</th><th>Var(A)</th><th>Polyphen Pred.</th><th>PMID</th><th>Cancer type</th><th>Source</th><th>Status</th><th>Report</th></thead>";
//$table.=PHP_EOL;
$table.="<tbody>";
$table.="<tr>";
$table.="<td> No result for ".$x." in BioMuta</td>";
$table.="</tr>";
$table.="</table>";
file_put_contents($flnm.$tempz,$string);
file_put_contents($flnm.$fdata,$table);

}else{


$flag=1;

//print($tedad[0]);
//echo "hello hello<br>"; 
$string.=PHP_EOL;
$string.="UniProt AC";
$string.=',';
$string.="UniProt ID";
$string.=',';
$string.="Gene Name";
$string.=',';
$string.="Accession";
$string.=',';
$string.="SNV Position";
 $string.=',';
 $string.="Position (N)";
 $string.=',';
 $string.="Ref(N)";
 $string.=',';
 $string.="Var(N)";
 $string.=',';
 $string.="Position(A)";
 $string.=',';
 $string.="Ref(A)";
 $string.=',';
 $string.="Var(A)";
 $string.=',';
 $string.="Polyphen_Pred";
 $string.=',';
 $string.="PMID";
 $string.=',';
 $string.="Cancer Type";
 $string.=',';
$string.="Source";
$string.=',';
$string.="Status";

$string.=PHP_EOL;


//<th>UniProtKB ID</th>

$table='';
//echo "<div>";
$table.="<thead><th >UniProtKB AC</th><th>Gene</th><th>Accession</th><th>SNV position</th><th>Pos(N)</th><th>Ref(N)</th><th>Var(N)</th><th>Pos(A)</th><th>Ref(A)</th><th>Var(A)</th><th>Polyphen Pred.</th><th>PMID</th><th>Cancer type</th><th>Source</th><th>Status</th><th>Comment</th></thead>";
$table.=PHP_EOL;
 

//array for charts
$posi=array();
$disi=array();
$cc=0;
$table.="<tbody>";
$row = mysql_fetch_array( $result );
$length=$row['UniProt_AC'];

$num_fields = mysql_num_fields($result); 
//while($row = mysql_fetch_array( $result ,MYSQL_ASSOC)) {
while($row = mysql_fetch_array( $result )){

     $email='';
     
	// Print out the contents of each row into a table
	$table.="<tr >";
	/////////////////UNIPROT AC
	if(isset($row['UniProt_AC'])){
	$string.=$row['UniProt_AC'];
	$email.=$row['UniProt_AC'];
	$string.=',';
	$email.=',';
	$table.="<td>";
	$table.="<a target=".'_blank'." href=".'http://www.uniprot.org/blast/?about='.$row['UniProt_AC'].'['.$row['Position_A'].']'."     >"; 
	$table.=$row['UniProt_AC'];
	$table.='</a>';
	$table.="</td>";
	}elseif(!isset($row['UniProt_AC'])){
	$string.='--,';
	$email.='--,';
	
	$table.="<td>--</td>";
	}
	//////////////////UNIPROT ID
	if(isset($row['UniProt_ID'])){
	$string.=$row['UniProt_ID'];
	$email.=$row['UniProt_ID'];
	$string.=',';
	$email.=',';
	//$table.="<td>";
	//$table.=$row['UniProt_ID'];
	//$table.="</td>";
	}elseif(!isset($row['UniProt_ID'])){
	$string.='--,';
	$email.='--,';
	}
	
	/////////////////GENE NAME
	if(isset($row['Gene_Name'])){
	$string.=$row['Gene_Name'];
	$email.=$row['Gene_Name'];
	$string.=',';
	$email.=',';
	$table.="<td>";
	for($ed=0;$ed<sizeof($edrn);$ed++){
	if(strtoupper($row['Gene_Name'])==$edrn[$ed][0]){
	$table.="<a  target=".'_blank'." href=".'http://edrn.nci.nih.gov/biomarkers/'.strtolower($edrn[$ed][1])."     >"; 
	break;
	}
	
	}
	$table.=$row['Gene_Name'];
	$table.="</a>";
	$table.="</td>";
	}elseif(!isset($row['Gene_Name'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	
	///////////////////////ACCESION
	if(isset($row['Accession'])){
	$string.=$row['Accession'];
	$email.=$row['Accession'];
	$string.=',';
	$email.=',';
	$table.="<td>";
	if(strpos($row['Accession'],'ENST')!== false)$table.="<a  title=".$row['Accession']." target=".'_blank'." href=".'http://useast.ensembl.org/Homo_sapiens/Transcript/Transcript?t='.$row['Accession'].''."     >";
	elseif(strpos($row['Accession'],'XM')!== false)$table.="<a title=".$row['Accession']."  target=".'_blank'." href=".'http://www.ncbi.nlm.nih.gov/nuccore/'.$row['Accession'].''."     >";
	elseif(strpos($row['Accession'],'NM')!== false)$table.="<a title=".$row['Accession']."  target=".'_blank'." href=".'http://www.ncbi.nlm.nih.gov/nuccore/'.$row['Accession'].''."     >";
	elseif(strpos($row['Accession'],'VAR')!== false)$table.="<a title=".$row['Accession']."  target=".'_blank'." href=".'http://web.expasy.org/variant_pages/'.$row['Accession'].'.html'."     >";
	else $table.="<a  title=".$row['Accession']."  target=".'_blank'." href=".'http://www.ncbi.nlm.nih.gov/gene/?term='.$row['Accession'].''."     >";
	$table.=$row['Accession'];
	$table.='</a></td>';
	}elseif(!isset($row['Accession'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	
	/////////////////////GENOME position
	if(isset($row['Genome_Position'])){
		$string.=$row['Genome_Position'];
		$email.=$row['Genome_Position'];
		$string.=',';
		$email.=',';
	     if($row['Genome_Position']!=='--'){
	     $table.="<td>";
	     $temp=explode(":",$row['Genome_Position']);
	     if(isset($temp[1])) $table.="<a title=".$row['Genome_Position']."  target=".'_blank'." href=".'http://genome.ucsc.edu/cgi-bin/hgTracks?org=human&position='.$temp[0].':'.$temp[1]."     >";  
	     $table.=$row['Genome_Position'];
	     $table.='</a>';
	     $table.="</td>";
	     }elseif($row['Genome_Position']=='--'){
	
	      $table.="<td>";
	      $table.="--";
	      $table.="</td>";
	     }
	}elseif(!isset($row['Genome_Position'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	
	
	///////////////////////POSITIONS
	if(isset($row['Position_N'])){
	
	$string.=$row['Position_N'];
	$email.=$row['Position_N'];
	$string.=',';
	$email.=',';
	$table.="<td >"; 
	$table.=$row['Position_N'];
	$table.="</td>";
	}elseif(!isset($row['Position_N'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	if(isset($row['Ref_N'])){
	$string.=$row['Ref_N'];
	$email.=$row['Ref_N'];
	$string.=',';
	$email.=',';
	$table.="<td>"; 
	$table.=$row['Ref_N'];
	$table.="</td>";
	}
	elseif(!isset($row['Ref_N'])){
		$string.='--,';
		$email.='--,';
		$table.="<td>--</td>";
	}
	if(isset($row['Var_N'])){
	$string.=$row['Var_N'];
	$email.=$row['Var_N'];
	$string.=',';
	$email.=',';
	$table.="<td >"; 
	$table.=$row['Var_N'];
	$table.="</td>";
	}elseif(!isset($row['Var_N'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	if(isset($row['Position_A'])){
	$posi[$cc]=$row['Position_A'];
	
	$string.=$row['Position_A'];
	$email.=$row['Position_A'];
	$string.=',';
	$email.=',';
	$table.="<td>"; 
	$table.=$row['Position_A'];
	$table.="</td>";
	}elseif(!isset($row['Position_A'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	if(isset($row['Ref_A'])){
	$string.=$row['Ref_A'];
	$email.=$row['Ref_A'];
	$string.=',';
	$email.=',';
	$table.="<td>"; 
	$table.=$row['Ref_A'];
	$table.="</td>";
	}elseif(!isset($row['Ref_A'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	
	
	if(isset($row['Var_A'])){
	$string.=$row['Var_A'];
	$email.=$row['Var_A'];
	$string.=',';
	$email.=',';
	$table.="<td>"; 
	$table.=$row['Var_A'];
	$table.="</td>";
	}elseif(!isset($row['Var_A'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	/////////////////////////'Polyphen_Pred'
	if(isset($row['Polyphen_Pred'])){
	$string.=$row['Polyphen_Pred'];
	$email.=$row['Polyphen_Pred'];
	$string.=',';
	$email.=',';
	$table.="<td>"; 
	$table.=$row['Polyphen_Pred'];
	$table.="</td>" ;
	}elseif(!isset($row['Polyphen_Pred'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	
	//////////////////////////////////PMID
	if(isset($row['PMID'])){
	$string.=$row['PMID'];
	$email.=$row['PMID'];
	$string.=',';
	$email.=',';
	$table.="<td>";
	$abbr=explode(";",$row['PMID']);
	$table.="<a  target=".'_blank'." href=".'http://www.ncbi.nlm.nih.gov/pubmed/?term='.$abbr[0].''."     >"; 
	$table.=$abbr[0];
	$table.='</a>';
	$table.="</td>";
	}elseif(!isset($row['PMID'])){
	$string.='--,';
	$email.='--,';
	$table.="<td>--</td>";
	}
	
	
	///////////////////////////////Cancer Type
	
	$string.=$row['Cancer_Type'];
	$email.=$row['Cancer_Type'];
	$disi[$cc]=$row['Cancer_Type'];
	
	$string.=',';
	$email.=',';
	if($row['Cancer_Type']!=='--' && strpos($row['Cancer_Type'],'[')!== false){
	$temp=explode("[",$row['Cancer_Type']);
	$name=$temp[0];
	$abbr=explode("]",$temp[1]);
	$new = str_replace(' ', '%20', $name);
	$tcancer = str_replace(' ', '--', $name);
	$table.="<td >";
	$table.="<a title=".$tcancer.$abbr[0]."  target=".'_blank'." href=".'https://tcga-data.nci.nih.gov/tcga/tcgaCancerDetails.jsp?diseaseType='.$abbr[0].'&diseaseName='.$new.''."     >"; 
	$table.=$row['Cancer_Type'];
	$table.='</a>';
	$table.="</td>";
	}elseif(strpos($row['Cancer_Type'],'[')== false){
	$table.="<td>";
	$table.= "<a title=".$tcancer.$abbr[0].">";
	 $table.=$row['Cancer_Type'];
	 $table.= "</a>";
	 $table.="</td>";
	}elseif($row['Cancer_Type']=='--'){
	$table.="<td>";
	 $table.="--";
	 $table.="</td>";
	}
	
	/////////////////////////////////Source
	if(isset($row['Source'])){
	  	$table.="<td>";
	 		if(strpos($row['Source'],'COS')!== false)$table.="<a title=".$row['Source']."  target=".'_blank'." href=".'http://cancer.sanger.ac.uk/cosmic/gene/overview?ln='.$row['Gene_Name'].''.">";
			elseif(strpos($row['Source'],'CSR')!== false)$table.="<a  title=".$row['Source']."  target=".'_blank'." href=".'http://hive.biochemistry.gwu.edu/tools/Cov/seq.cgi?cmd=Glyco&SRA=Cancer&Search='.$row['UniProt_AC'].''.">";
			elseif(strpos($row['Source'],'Cli')!== false)$table.="<a  title=".$row['Source']."  target=".'_blank'." href=".'http://www.ncbi.nlm.nih.gov/clinvar/?term='.$row['Gene_Name'].''.">";
			elseif(strpos($row['Source'],'Uni')!== false)$table.="<a title=".$row['Source']."   target=".'_blank'." href=".'http://www.uniprot.org/uniprot/'.$row['UniProt_AC'].''.">";
		$table.=$row['Source'];
	    $table.='</a></td>';
		$string.=$row['Source'];
		$email.=$row['Source'];
		$string.=',';
		$email.=',';
		
		}
	elseif(!isset($row['Source'])){
		$string.='--,';
		$table.="<td>--</td>";
		}
	////////////////////////////////Status
	if(isset($row['Status'])){
	$string.=$row['Status'];
	$email.=$row['Status'];
	$string.=PHP_EOL;
	$table.="<td>"; 
	if($row['Status'][0]=='L') $table.='LG';
	//$table.="<img src=".'index_files/Silver.png'." border=".'0'." width=".'20'." height=".'20'.">";
	else $table.='SM';
	//$table.="<img src=".'index_files/gold.png'." border=".'0'." width=".'22'." height=".'22'.">";
	// echo $row['Status'];
	
	$table.="</td>";
	}elseif(!isset($row['Status'])){
	$string.='--';
	$email.='--';
	$string.=PHP_EOL;
	$table.="<td>--</td>";
	}
	$email = str_replace(' ', '--', $email);
	////////////////////////////////Report
	$table.="<td>";
	$table.="<a title='Contribute to BioMuta' href=".'mailto:xlhive.jira@gmail.com?subject=[HIVE%20JIRA]%20(GWU-445)%20BioMuta&body=Please%20Take%20a%20look%20at%20the%20following%20record%0D%0A'.$email." target=".'_top'.">";
	$table.="<img src=".'index_files/letter.ico'." border=".'0'." width=".'10'." height=".'10'.">";
	
    $table.="</td>";
	
	$table.="</tr>";
	$cc++;
	 
}
//} 
 
 

////////////////////////////
$table.="</tbody>";
file_put_contents($flnm.$tempz,$string);
file_put_contents($flnm.$fdata,$table);
$caption=$cc.' Results for '.$x.' in BioMuta';
}
//echo "cc";
//echo $cc;
?>
<?php include('login.php'); ?>
<!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
		
<link rel="stylesheet" type="text/css" href="jquery-ui/css/redmond/jquery-ui-1.8.4.custom.css"/>
<link rel="stylesheet" type="text/css" href="jquery-ui/css/ui-lightness/jquery-ui-1.8.4.custom.css"/>
<link rel="stylesheet" type="text/css" href="jquery-ui/css/smoothness/jquery-ui-1.8.4.custom.css"/>
<link rel="stylesheet" type="text/css" href="jquery-ui/css/flick/jquery-ui-1.8.4.custom.css" id="link"/>
<link rel="stylesheet" type="text/css" href="css/base.css" />

<script type="text/javascript" src="highlighter/codehighlighter.js"></script>	
<script type="text/javascript" src="highlighter/javascript.js"></script>			
<script type="text/javascript" src="javascript/jquery.fixheadertable.min.js"></script>		
-->

<script type="text/javascript" src="javascript/jquery.fixheadertable.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="javascript/jquery.fixheadertable.min.js"></script>


<!-- code for diagram -->

<?php
if($flag==1){
$freq=array_count_values($disi);
//print_r($freq);
//echo "<br>";
asort($posi);
$freq2=array_count_values($posi);
//echo (sizeof($udisi));
//echo"<br>";
$text="['Disease', 'Position frequency']";
while (current($freq)!== FALSE) {
$text.=",['".key($freq)."',".current($freq)."]";
next($freq);
}
$text2="['SNP position', 'Cancer frequency']";
while (current($freq2)!== FALSE) {
$text2.=",['".key($freq2)."',".current($freq2)."]";
next($freq2);
}
}
?>








<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {packages:["corechart"]});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart1);
      google.setOnLoadCallback(drawChart2);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
	function drawChart1() {

	var data = google.visualization.arrayToDataTable([
    	      <?php if($flag==1) echo $text;?>
        	]);

  	var options = {
    		hAxis:{title: 'Cancer Type',titleTextStyle:{fontSize:13,bold:true},slantedText:true},
    		vAxis:{title:'# of positions affected by specific cancer types',titleTextStyle:{fontSize:13,bold:true},gridlines:{count: 5}},
    		bar:{groupWidth:'10%'},
    		animation:{
        				duration: 1000,
       					 easing: 'out',
     					 },
    		chartArea:{left:"15%",width:"80%",height:"40%"},
    		legend: { position: 'none', maxLines: 2 },
    		//title:'Number of position affected by Cancer Types',
    		//titlePosition:'out',
    		//titleTextStyle:{fontSize:14},
    		//isStacked:'false',
    		fontSize:'12'
  	};
  	// Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
        
        // Instantiate and draw our chart, passing in some options.
        
}  	
function drawChart2() {

        	var data = google.visualization.arrayToDataTable([
          	<?php 
          	if($flag==1)echo $text2;
          	?>
        ]);

  var options = {
    hAxis:{title: 'Protein position',titleTextStyle:{fontSize:12,bold:true},slantedText:true},
    vAxis:{title:'# of specific cancer types',titleTextStyle:{fontSize:12,bold:true},gridlines:{count: 3}},
    bar:{groupWidth:'3%'},
    legend: { position: 'none', maxLines: 2 },
    chartArea:{left:"10%",width:"80%",height:"40%"},
    animation:{
        				duration: 1000,
       					 easing: 'out',
     					 },
    //title:'Number of position affected by Cancer Types',
    //titlePosition:'out',
    //titleTextStyle:{fontSize:14},
    //isStacked:'false',
    fontSize:'10',
    width:1120,
    height:400
    
 		 };
 		 
 		         
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
        
        // Instantiate and draw our chart, passing in some options.
        
 	}
         
		

      
    </script>



















<script type="text/javascript">  

    
					
			$(document).ready(function() {  	
				
				$.ajax({						
					url: "downfile.php?file=<?php echo $fdata;?>",						
					success: function(data) {
					$('#0').html(data).fixheadertable({ 
							caption : '<?php echo $caption;?>', 
							colratio : [80,55,70,140,48,43,48,50,43,43,115,70,165,60,45,65], 
							height : 400, 
							width : 1140, 
							zebra : false, 
							sortable : true, 
							sortedColId : 7, 
							sortType : ['string','string', 'string', 'string', 'integer','string','string','integer','string','string','string','integer','string','string','string','string'],
							dateFormat : 'm/d/Y',
							pager : true,
							rowsPerPage	 : 10,
							resizeCol : true,
							minColWidth    : 40,
							
						});
					}
				});
					$('<br/><a style="cursor : pointer">[ Show code ]</a>').insertBefore('pre').click(function(){
					if($(this).html() == "[ Show code ]"){
						$(this).html("[ Hide code ]");
					}else{
						$(this).html("[ Show code ]");
					}						
					$(this).next('pre').toggle();
				});
				
					});
		</script>			
<style type="text/css">		
			body {
				font-family : Verdana,Arial,Geneva,Helvetica,sans-serif;
				font-size	: 10px;
			}
			
			pre {				
				padding		: 5px;	
				font-size	: 10px;
				border		: 2px solid #F0F0F0;
				background	: #F5F5F5;
				width		: 100%;
				display		: none;
				width 		: 800px
			}
			
			.javascript  .comment {
				color : green; 
			}
			
			.javascript  .string {
				color : maroon;
			}
			
			.javascript  .keywords {
				font-weight : bold;
			}
			
			.javascript  .global {
				color : blue;
				font-weight : bolder;
			}
			
			.javascript  .brackets {
				color : Gray;
			}
			
			.javascript  .thing {
				font-size : 10px;
			}			
			
			span.text {
				font-weight : normal;
				font-style	: italic;
				margin-left : 10px;			
			}		
			
			div.title {
				font-size	: 18px;
				padding 	: 15px 0;
				font-weight : bold;
			}
			
			div.title span {
				font-weight : normal;
			}
			
			div.themes {
				overflow	: hidden;
    			width		: 150px;
    			position	: fixed;
    			top			: 180px;
    			left		: 10px;
			}
			
			div.themes button {
				width		: 120px;
				margin-bottom : 5px;
			}
			
			div.themes a {
			    display			: block;
			    font-size		: 1.1em;
			    margin-bottom	: 5px;
			    text-decoration	: none;
			    padding 		: 3px;
			    width			: 120px;
			}
			
			div.themes a:focus {
				outline : none;
			}
			
			div.themes a.top {
				color : black;
			}
			
			div.themes a.top:hover {
				text-decoration : underline;
			}
#Tabs ul {
padding: 0px;
margin: 0px;
margin-left: 10px;
list-style-type: none;
}

#Tabs ul li {
display: inline-block;
clear: none;
float: left;
height: 24px;
}

#Tabs ul li a {
position: relative;
margin-top: 16px;
display: block;
margin-left: 6px;
line-height: 24px;
padding-left: 10px;

z-index: 9999;
border: 1px solid #ccc;
border-bottom: 0px;

/* The following four lines are to make the top left and top right corners of each tab rounded. */
-moz-border-radius-topleft: 4px;
border-top-left-radius: 4px;
-moz-border-radius-topright: 4px;
border-top-right-radius: 4px;
/* end of rounded borders */

width: 130px;
color: #000000;
text-decoration: none;
font-weight: bold;
}

#Tabs ul li a:hover {
text-decoration: underline; // a very simple effect when hovering the mouse on tab
}

#Tabs #Content_Area { // this is the css class for the content displayed in each tab
padding: 0 15px;
clear:both;
overflow:auto;
line-height:19px;
position: relative;
top: 20px;
z-index: 5;
height: 400px;
width:1120px;
overflow: hidden;
border:1px solid #ccc;
border-radius:10px;
}

p { padding-left: 15px; }

.a_focus {

padding: 0px;
margin: 0px;

list-style-type: none;

background-color: #5c9ccc;
}	
</style>


<div id="body_container" align="left" style="height:500px; margin-top:5%">
<div id="top_template">
	<h2 id="cgiLocation" style="border: none;font-family:Arial, Helvetica, sans-serif;font-size: 20px;" >BioMuta v1.0</h2>
	<div id="top_image">
</div>

	</div>

<p style="font-family:Arial, Helvetica, sans-serif;font-size: 14px;" >BioMuta is a curated single-nucleotide variation (SNV) and disease association database where the variations are mapped to the genome/protein/gene.	</p>


		
			
		
	<!--<body style="background-color : #FFFFFF; overflow-x : hidden">	-->
<fieldset style="border:0";>	
<div>
<fieldset style="display:inline;vertical-align:top;">
<legend style="font-family:Arial, Helvetica, sans-serif;font-size: 14px;" >Help</legend>
<table>
<tbody>
<td>
<p>
Status:
<ul>
<li>Small-scale study (SM): Less than 1000 sites/PMID</li>
<li>Large-scale study (LG): Higher than 1000 sites/PMID </li>
</ul>
</p>
<p>
Version
<ul>
<li>Cosmic v65_280513 </li>
<li>Clinvar v2013_11 </li>
<li>UniProt v2013_10 </li>
</ul>
</p>


</td>
</tbody>	
</table>							
</fieldset>
		
<div id="Tabs">
	<ul>
		<li  onclick="tab('tab1')" ><a id="li_tab1" class="a_focus">Cancer Type/Freq.</a></li>
		<li  onclick="tab('tab2')"><a  id="li_tab2" >SNP Position/Freq.</a></li>
	</ul>
	<div id="Content_Area">
		<div id="tab1">
		
			<div id="chart_div1" style="width:1120px; height: 400px;"></div>
   		 
				<?php
				// bar chart should go in there 
				$turl='http://www.uniprot.org/uniprot/'.$length.'.xml';
				$xml = simplexml_load_file($turl);
				//$string='';
				//print($xml->entry->sequence[@length]);
                ?>
		</div>
	

		<div id="tab2" style="display: none;">
			<div id="chart_div2"></div>
		</div>	
	</div> <!– End of Content_Area Div –>
</div> <!– End of Tabs Div –>




	
</fieldset>	

<br>
<br>
<table width="100">

<td>
<a align="left" href="#" onclick="javascript:window.history.back(-1);return false;"><img align="left" src="index_files/Back.png" alt="back_image" height="35" width="50" border="0">
</a>	
 </td>

<a align="right" href="download.php?file=<?php echo $tempz;?>"  target="_blank"  >
  <img align="right" src="index_files/down1.png" alt="sample_image" height="30" width="90" border="0"> 
  </a>
	

</table>
		
	<br>	 
	
		<!--  EXAMPLES -->
		
			
<table class="resultset" id="0"></table>
					

<script type="text/javascript">
function tab(tab) {
	document.getElementById('tab1').style.display = 'none';
	document.getElementById('tab2').style.display = 'none';
	document.getElementById('li_tab1').setAttribute("class", "");
	document.getElementById('li_tab2').setAttribute("class", "");
	document.getElementById(tab).style.display = 'block';
	document.getElementById('li_'+tab).setAttribute("class", "a_focus");
}
</script>		
	
		
<?php
endPage();
?>
