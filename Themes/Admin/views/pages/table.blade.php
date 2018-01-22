@extends('layouts.facile_master')
@section('content')

<div class="main--content" id="app">
    <h3 class="main--content__title">Tables</h3>
    <small class="main--content__desc">Here are few table styles for you to choose</small>

    <div class="grid">
        <div class="span6">
            <div class="card__wrapper">
                <h6 class="bold card--title s12">Bar Chart</h6>
                <div class="card">
                    <div class="card__body">
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Purchase Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center-align">1</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Innova (One Way)</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status waiting">Waiting</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">2</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>Mercedes Benz</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status paid">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">3</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Aquatonic</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status expired">Expired</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">4</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>Mercedes Benz</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status paid">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">5</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Aquatonic</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status expired">Expired</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="card__wrapper">
                <h6 class="bold card--title s12">Table with Filter</h6>
                <div class="card">
                    <div class="card__header flex vend noborder">
                        <form action="">
                            <div class="row">
                                <div class="field">
                                    <label class="">TRANSACTION DATE</label>
                                    <div class="input--icon icon--right input--date">
                                        <input type="text" placeholder="DD-MM-YYYY" class="datepick mini">
                                        <i class="icon-date"></i>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="">&nbsp;</label>
                                    <div class="input--icon icon--right input--date">
                                        <input type="text" placeholder="DD-MM-YYYY" class="datepick mini">
                                        <i class="icon-date"></i>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="">CATEGORY</label>
                                    <select name="" id="" class="chosen mini">
                                        <option value="">Option 1</option>
                                        <option value="">Option 2</option>
                                        <option value="">Option 3</option>
                                        <option value="">Option 1</option>
                                        <option value="">Option 2</option>
                                        <option value="">Option 3</option>
                                        <option value="">Option 1</option>
                                        <option value="">Option 2</option>
                                        <option value="">Option 3</option>
                                        <option value="">Option 1</option>
                                        <option value="">Option 2</option>
                                        <option value="">Option 3</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label class="">Search</label>
                                    <div class="input--icon icon--left">
                                        <input type="email" class="mini" placeholder="Email Address">
                                        <i class="ico-search"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card__body">
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Purchase Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center-align">1</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Innova (One Way)</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status waiting">Waiting</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">2</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>Mercedes Benz</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status paid">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">3</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Aquatonic</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status expired">Expired</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid">
        <div class="span6">
            <div class="card__wrapper">
                <h6 class="bold card--title s12">Basic Table with Row Separator</h6>
                <div class="card">
                    <div class="card__body">
                        <table cellpadding="0" cellspacing="0" class="even">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Purchase Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center-align">1</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Innova (One Way)</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status waiting">Waiting</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">2</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>Mercedes Benz</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status paid">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">3</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Aquatonic</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status expired">Expired</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">4</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>Mercedes Benz</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status paid">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">5</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Aquatonic</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status expired">Expired</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="card__wrapper">
                <h6 class="bold card--title s12">Basic Table with Row Separator</h6>
                <div class="card">
                    <div class="card__body">
                        <table cellpadding="0" cellspacing="0" class="border">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Purchase Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center-align">1</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Innova (One Way)</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status waiting">Waiting</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">2</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>Mercedes Benz</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status paid">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">3</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Aquatonic</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status expired">Expired</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">4</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>Mercedes Benz</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status paid">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center-align">5</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>Aquatonic</td>
                                    <td>Airport Transfer</td>
                                    <td>IDR 7,200,000</td>
                                    <td>11-30-2016</td>
                                    <td>
                                        <span class="status expired">Expired</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid">
        <div class="span6">
            <div class="card__wrapper">
                <h6 class="bold card--title s12">Table with Total</h6>
                <div class="card">
                    <div class="card__body">
                        <table cellpadding="0" cellspacing="0" class="">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th>Order ID</th>
                                    <th>Currency</th>
                                    <th>CPC</th>
                                    <th>Revenue</th>
                                    <th>Cost</th>
                                    <th>CPO</th>
                                    <th>CTR</th>
                                    <th class="center-align">All Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total">
                                    <td></td>
                                    <td>Totals</td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$31,468.71</td>
                                    <td>$4,375.21</td>
                                    <td>$4,375.21</td>
                                    <td>$4,375.21</td>
                                    <td class="center-align">26</td>
                                </tr>
                                <tr>
                                    <td class="center-align">1</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr>
                                    <td class="center-align">2</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">0</td>
                                </tr>
                                <tr>
                                    <td class="center-align">3</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">1</td>
                                </tr>
                                <tr>
                                    <td class="center-align">4</td>
                                    <td>
                                        <a href="#" class="link link-edit">RMB123456</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr>
                                    <td class="center-align">5</td>
                                    <td>
                                        <a href="#" class="link link-edit">AYN123456</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="card__wrapper">
                <h6 class="bold card--title s12">Table with Sub-item</h6>
                <div class="card">
                    <div class="card__body">
                        <table cellpadding="0" cellspacing="0" class="treetable" id="nested-1">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th>Order ID</th>
                                    <th>Currency</th>
                                    <th>CPC</th>
                                    <th>Revenue</th>
                                    <th>Cost</th>
                                    <th>CPO</th>
                                    <th>CTR</th>
                                    <th class="center-align">All Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total">
                                    <td></td>
                                    <td>Totals</td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$31,468.71</td>
                                    <td>$4,375.21</td>
                                    <td>$4,375.21</td>
                                    <td>$4,375.21</td>
                                    <td class="center-align">26</td>
                                </tr>
                                <tr data-depth="0" class="">
                                    <td class="center-align">
                                        <a href="#" class="toggle"></a>
                                    </td>
                                    <td>
                                        <a href="#" class="link link-edit">Tue 08/06/2017</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>

                                <tr data-depth="0" class="">
                                    <td class="center-align">
                                        <a href="#" class="toggle"></a>
                                    </td>
                                    <td>
                                        <a href="#" class="link link-edit">Wed 09/06/2017</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="0" class="">
                                    <td class="center-align">
                                        <a href="#" class="toggle"></a>
                                    </td>
                                    <td>
                                        <a href="#" class="link link-edit">Thu 10/06/2017</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="0" class="">
                                    <td class="center-align">
                                        <a href="#" class="toggle"></a>
                                    </td>
                                    <td>
                                        <a href="#" class="link link-edit">Fri 11/06/2017</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="0" class="">
                                    <td class="center-align">
                                        <a href="#" class="toggle"></a>
                                    </td>
                                    <td>
                                        <a href="#" class="link link-edit">Sat 12/06/2017</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                                <tr data-depth="1" class="nested hide">
                                    <td></td>
                                    <td>
                                        <a href="#" class="link link-edit">00:00 - 00:59</a>
                                    </td>
                                    <td>USD</td>
                                    <td>$0.71</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td>$2,421.00</td>
                                    <td class="center-align">2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js_script')
<script src="{{ elixir('js/facile_main.js', 'themes/admin')}}"></script>
@endsection