renderResults = () => {
  if(this.state.messageNum !== ''){

    if(this.state.messageNum == 1){
      let options = <span>{this.state.displayOptions}</span>;
      return (
        <div>
          <div>
          Results: {this.state.getProducts.length}<br/><br/>
            You searched on: Risk level ({this.state.displayRiskLevel}), Minimum investment (${this.state.displayMinInvestment})
          </div>
          <div>
            Products: {options}<br/><br/>
          </div>
            {this.state.message}<br/><br/>
            {this.state.getProducts.map((product,index)=>(
                <div>
                <div><h3>{product.name}</h3></div>
                <div><h4>{product.summary}</h4></div>
                <span>Risk level: {product.riskLevel} </span><span>Minimum investment: ${product.minInvestment} </span><span>Type of investment: {product.isStock}</span>
                <div><br/><br/></div>
                </div>

            ))}
        </div>
      )
    }
    else if (this.state.messageNum == 0) {
      console.log(this.state.messageNum + 'hiya');
      return (
        <div>
        <div>
          You searched on: Risk level ({this.state.displayRiskLevel}), Minimum investment (${this.state.searchCriteria[1]})
        </div>
        <div>
          Products: {this.state.displayOptions}<br/><br/>
        </div>
          {this.state.message}
        </div>
      )
    }
    else {
      return "";
    }
  }
}



          <UserInfoRisk handleRiskLevel={this.handleRiskLevel}/>
