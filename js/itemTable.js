const fetchInvoiceList = () => {
    return fetch(`http://${window.location.host}/getInvoiceList`);
}
const changeCheckedData = (orderItems, index, value) => {
    const newOrderItems = [...orderItems];
    newOrderItems[index].checked = value;
    return newOrderItems;
}
const changeQuantityData = (orderItems, index, value) => {
    const newOrderItems = [...orderItems];
    newOrderItems[index].quantity = value;
    return newOrderItems;
}
const ItemTable = () => {
        const [invoiceNo, setInvoiceNo] = React.useState(0);
        const [photo, setPhoto] = React.useState(null);
        const [invoiceDataMap, setInvoiceDataMap] = React.useState({});
        const [invoiceOptions, setInvoiceOptions] = React.useState([]);
        const [orders, setOrders] = React.useState([]);
        React.useEffect(() => {
            fetchInvoiceList()
            .then(response => response.json())
            .then(data => {
                const invoices = data.data;
                const dataMap = {};
                invoices.map((invoice) => {
                    dataMap[invoice.invoice_no] = {
                        invoice_no: invoice.invoice_no,
                        orders: invoice.order_request,
                    };
                });
                setInvoiceDataMap(dataMap);
                const options = [];
                Object.keys(dataMap).map((invoiceNo, index) => {
                    options.push(<option value={invoiceNo} key={index}>{invoiceNo}</option>);
                });

                setInvoiceOptions(options);
            });
        },[]);
        const createOrderData = (orders) => {
            return orders.map(order => {
                return {...order, checked: false}
            });
        }
        const handleInvoiceChange = (e) => {
            setInvoiceNo(e.target.value);
            setOrders(invoiceDataMap[e.target.value] ? 
                createOrderData(invoiceDataMap[e.target.value].orders) : []
            );
        }
        const handleCheckBoxChange = (index, e) => {
            setOrders(changeCheckedData(orders, index, e.target.value));
        }
        const handleQuantityChange = (index, e) => {
            setOrders(changeQuantityData(orders, index, e.target.value));
        }
        const handlePhoto = (e) => {
            setPhoto(e.target.files[0]);
        }
        return (
            <div className="row">
             <div className="col-md-4">
                <div className="row">
                    <div className="col-xs-12 col-sm-12 col-md-12">
                        <div className="form-group">
                            <strong><span className="text-danger">*</span>Invoice No:</strong>
                            <select className="form-control" name="invoice_no" id="invoice_no" onChange={handleInvoiceChange} value={invoiceNo}>
                                 <option value={'0'}>Choose Invoice No</option>
                                { invoiceOptions }
                            </select>
                        </div>
                    </div>
                    <div className="col-xs-12 col-sm-12 col-md-12">
                       <div className="form-group">
                            <strong><span className="text-danger">*</span>Photo:</strong>
                             <input type="file" className="form-control-file" name="company_ref_id" id="company_ref_id" placeholder="Company Reference" aria-describedby="fileHelpId" required onChange={handlePhoto}/>
                             <div className="invalid-feedback">
                                Please upload your Photo
                             </div>
                       </div>
                    </div>
                    <div className="col-xs-12 col-sm-12 col-md-12 ">
                        <a className="btn btn-secondary" href="/credit-returns">Back</a>
                        <button type="submit" className="btn btn-primary">Save</button>
                    </div>
                </div>
             </div>
             <div className="col-md-8">
                <div className="itemTable">
                    <table className="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Item No</th>
                                <th>Pack Size</th>
                                <th>Description</th>
                                <th>Quanity</th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                                orders.map((order, index) => {
                                    return  <tr key={index}>
                                        <td>
                                            <div className="form-check">
                                                <input type="checkbox" className="form-check-input" name="" id="" value="checkedValue" checked={order.checked} onChange={(e) => handleCheckBoxChange(index,e)}/>
                                            </div>
                                        </td>
                                        <td scope="row">{order.item_no}</td>
                                        <td>{order.pack_size}</td>
                                        <td>{order.description}</td>
                                        <td>
                                              <input type="text" className="form-control" name="" id="" aria-describedby="helpId" placeholder="" value={order.quantity} onChange={(e) => handleQuantityChange(index,e)}/>
                                        </td>
                                    </tr>
                                })
                            }
                           
                        </tbody>
                    </table>
                </div>
             </div>
         </div>
        )
}

const domContainer = document.querySelector('#itemTable');
ReactDOM.render((<ItemTable/>), domContainer);
