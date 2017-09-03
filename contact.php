<?php
$category = $_POST["category"];
$question = $_POST["question"];
$name = $_POST["name"];
$email = $_POST["email"];

$qLength = (strlen($question) < 25);
$nLength = (strlen($name) < 10);
$eLength = (strlen($email) < 10);

$noAt = (strpos($email, "@") == -1);
$noDot = (strpos($email, ".") == -1);

$saleSelected = $returnSelected = $shipSelected = $otherSelected = "";
# These must all be initialized as empty strings otherwise the options that aren't selected will cause the page to break

switch ($category) {
	case "Sales":
		$saleSelected = 'selected="selected"';
		break;
	case "Returns":
		$returnSelected = 'selected="selected"';
		break;
	case "Shipping":
		$shipSelected = 'selected="selected"';
		break;
	case "Other":
		$otherSelected = 'selected="selected"';
		break;
}

$qWrong = $nWrong = $eWrong = ""; # By setting these to empty strings now, I can avoid having to set them as such within each if, thus saving space

if ($qLength && $nLength && ($eLength || $noAt || $noDot)) {
	$qWrong = 'Question must have at least 25 characters. ';
	$nWrong = 'Name must have at least 10 characters. ';
	$eWrong = 'Email must have at least 10 characters, an "@" and at least one ".".';
} elseif ($qLength && $nLength) {
	$qWrong = 'Question must have at least 25 characters. ';
	$nWrong = 'Name must have at least 10 characters.';
} elseif ($nLength && ($eLength || $noAt || $noDot)) {
	$nWrong = 'Name must have at least 10 characters. ';
	$eWrong = 'Email must have at least 10 characters, an "@" and at least one ".".';
} elseif ($qLength && ($eLength || $noAt || $noDot)) {
	$qWrong = 'Question must have at least 25 characters. ';
	$eWrong = 'Email must have at least 10 characters, an "@" and at least one ".".';
} elseif ($qLength) {
	$qWrong = 'Question must have at least 25 characters.';
} elseif ($nLength) {
	$nWrong = 'Name must have at least 10 characters.';
} elseif ($eLength || $noAt || $noDot) {
	$eWrong = 'Email must have at least 10 characters, an "@" and at least one ".".';
} else {
	;
} # This last else is needed as otherwise it would always act as if there was a mistake in the email and would never send

$errormsg = "<strong>Query sent!</strong>"; # Similar principle here as earlier, now I do not need an else after the if
if ($qLength || $nLength || $eLength || $noAt || $noDot) {
	$errormsg = '<strong>Error: </strong>' . $qWrong .  $nWrong .  $eWrong . '</div>';
}

if ($errormsg == "Query sent!") { # If there was no need to change it, there are no mistakes
	mail(
		"example@example.com", # I've taken out my own email address for GitHub - change this to your email.
		"Customer Query re: $category",
		"Category: $category\nQuestion: $question\nName: $name\nEmail: $email",
		"Reply-To: apache@danu3.it.nuigalway.ie\r\nX-Mailer: PHP/" . phpversion()
	);
}

include "top.html";
echo '<td id="content">
				<h2>Contact Information</h2>
				<dl>
					<dt class="jobtitle">Fulfilment Executive<dt>
					<dd>
						<p>John O\'Brady</p>
						<p>091 123 9988</p>
						<p>jobrady@getflagged.com</p>
					</dd>
					<dt class="jobtitle">Marketing Officer<dt>
					<dd>
						<p>Aoife Colfer</p>
						<p>091 777 6542</p>
						<p>aoife.marketing@getflagged.com</p>
					</dd>
					<dt class="jobtitle">Secretary<dt>
					<dd>
						<p>Jim Kennedy</p>
						<p>091 121 6666</p>
						<p>jim.kennedy@getflagged.com</p>
					</dd>
				</dl>' .
				'<div id="formValidate">' . $errormsg . '</div>';

echo "<form name=\"contact\" method=\"post\" action=\"contact.php\">
		<fieldset>
			<legend>Contact Form</legend>
			<table>
				<tr>
					<td class=\"formcaption\">Category:</td>
					<td><select name=\"category\">
						<option value=\"Sales\" $saleSelected>Sales</option>
						<option value=\"Returns\" $returnSelected>Returns</option>
						<option value=\"Shipping\" $shipSelected>Shipping</option>
						<option value=\"Other\" $otherSelected>Other (please specify in question)</option>
					</select></td>
				</tr>";
							
echo '<tr>
		<td class="formcaption q">Question:</td>
		<td class="q"><textarea name="question" rows="6" cols="38">' . $question . '</textarea></td>
	</tr>' .
	'<tr>
		<td class="formcaption">Name:</td>
		<td><input name="name" type="text" size="38" value="' . $name . '"></td>
	</tr>' .
	'<tr>
		<td class="formcaption">Email:</td>
		<td><input name="email" type="text" size="38" value="' . $email . '"></td>
	</tr>';

echo '						<tr>
								<td></td>
								<td><input type="submit" value="Submit Query" onclick="validate();"></td>
							</tr>
						</table>
					</fieldset>
				</form>
			</td>';

include "footer.html";
?>