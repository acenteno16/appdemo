<?

###

/*


Payments types:

- Pagos tradicioneles:
	type='1'; 
- Pasantes (Billetera movil):
	parent='1', type='2'
- Viaticos (Cuenta bancaria)
	parent='2', type='3'
- Viaticos (Billetera movil)
	parent='2', type='5' 
- Devoluciones
	type='4'	
- Memo

- Capital Humano



table name: bills
Table descripcion: Esta tabla es para guardar facturas y otro dito de documentos como notas de debito, cobro, contratos etc.

id: ID del registro en la tabla
payment: ID de la solicitúd (De esta manera vinculamos la dactura a la solicitud de pagop)
number: No de la factura fisica
amount: monto de la factura
letters: cantidad en letra del monto de lafactura
stotal: subtotal que graba IVA
stotal2: Subtotoal exento de IVA
tax: impuesto de venta
intur: impuesto de turismo
Exempt: si es exento de impuesto IMI
Exempt2: Si es exento de impuesto IR
Type: Tipo de gasto
Concept: Concepto de gasto 
Concet2: Categoria de gasto
billdate: Fecha de docuemto
billdate2: Fecha de recibido de documento
billpayment: Monto a pagar menos las retenciones
ret1: porcentaje retencion IMI
ret1a: monto retencion IMI
ret2: porcentaje retencion IR
ret2a: Monto rentencion IR
currency: moneda de la factura
tc: tipo de cambio
nioammount: Monto en cordobas (Aplica cuando la factura es en dolares, aqui se le da la conversion al tipo oficial de cambio)
niostotal: Subtotal en cordobas
niotax: impuesto de venta en cordobas
niointur: monto intur en cordobas
niobillpayment: monto a pagar menos retenciones en cordobas
inturammount: monto intur (En la moeda de la factura)
cut: corte de periodo fiscal
nd
dtype
billdate3
billdate4
billdate5
billdate6
billcomments
ipolicy
iquotaqq
iquotano
iquotaexpiration
retfamily
ddelete:

*/

?>