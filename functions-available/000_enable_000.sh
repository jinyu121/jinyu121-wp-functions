for req in $(cat 000_enablelist_000); do 
    mv $req ../functions-enabled/$req;
done
