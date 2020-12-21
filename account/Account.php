<?php
class Client {
	private $id;
	private $name;

	//TODO: implementar getter y setters $id y $name
	public function setId($id) {
		$this->id = $id;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}
}

class Movement {
	public $currency; // Puede ser 'USD' o 'ARS'
	public $amount; // Puede ser un número positivo o negativo

	function Movement($currency, $amount) {
		$this->currency = $currency;
		$this->amount = $amount;
	}

	public function getCurrency() {
		return $this->currency;
	}

	public function getAmount() {
		return $this->amount;
	}
}

class Account {
	private $client;
	private $cvu;
	private $movements;

	// Permite remover los acentos del nombre del cliente
	private function removeAccents() {
		$modifiedName = $this->client->getName();

		$modifiedName = str_replace(
			array('Á', 'À', 'á', 'à'),
			array('A', 'A', 'a', 'a'),
			$modifiedName
		);

		$modifiedName = str_replace(
			array('É', 'È', 'é', 'è'),
			array('E', 'E', 'e', 'e'),
			$modifiedName
		);

		$modifiedName = str_replace(
			array('Í', 'Ì', 'í', 'ì'),
			array('I', 'I', 'i', 'i'),
			$modifiedName
		);

		$modifiedName = str_replace(
			array('Ó', 'Ò', 'ó', 'ò'),
			array('O', 'O', 'o', 'o'),
			$modifiedName
		);

		$modifiedName = str_replace(
			array('Ú', 'Ù', 'ú', 'ù'),
			array('U', 'U', 'u', 'u'),
			$modifiedName
		);

		return $modifiedName;
	}

	// Permite obtener el nombre del cliente formateado
	private function getFormattedClientName() {
		$modifiedName = $this->removeAccents();
		$modifiedName = strtoupper($modifiedName);
		$modifiedName = str_replace(" ", ".", $modifiedName);

		return $modifiedName;
	}

	//TODO: implementar getCvu > obtiene el CVU de la cuenta
	public function getCvu() {
		if (!isset($this->cvu))
			$this->cvu = $this->client->getId() . "-" . $this->getFormattedClientName();

		return $this->cvu;
	}

	//TODO: implementar setClient > Asigna el cliente de la cuenta
	public function setClient($client) {
		$this->client = $client;
	}

	//TODO: implementar addMovement > permite agregar un movimiento a la cuenta
	public function addMovement($movement) {
		if (!isset($this->movements))
			$this->movements = array();

		array_push($this->movements, $movement);
	}

	//TODO: implementar getBalance > permite obtener el saldo de la cuenta en ARS o USD
	public function getBalance($currency) {
		if (!empty($this->movements)) {
			if ($this->currencyExists($currency)) {
				$balance = 0;

				foreach ($this->movements as $m)
					if ($m->getCurrency() == $currency)
						$balance += $m->getAmount();

				return $balance;
			}
			else
				return null;
		}
		else
			return null;
	}

	// Permite saber si existe la moneda dentro del array de movimientos
	private function currencyExists($currency) {
		if (!empty($this->movements)) {
			$i = 0;

			while ($i < count($this->movements) && $currency != $this->movements[$i]->getCurrency())
				$i++;
			
			if ($i < count($this->movements))
				return true;
			else
				return false;
		}
		else
			return false;
	}
}